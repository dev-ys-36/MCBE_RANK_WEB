<?php

date_default_timezone_set('Asia/Seoul');

include "./vendor/autoload.php";

include "./AddManager.php";

include './utils/DataManager.php';

include './query/Query/MinecraftQuery.php';

use React\Http\Io\UploadedFile;

function getTime(): string {
	return '[' . date("H시 i분 s초") . '] ';
}

function ip_log($request){
	if (!isset($request->getHeaders()['X-Forwarded-For'][0])){
		return getTime() . '[' . $request->getServerParams()['REMOTE_ADDR'] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']';
		//var_dump($request->getHeaders());
	}else{
		return getTime() . '[' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']';
	}
}

function get_ip($request){
	if (!isset($request->getHeaders()['X-Forwarded-For'][0])){
		return $request->getServerParams()['REMOTE_ADDR'];
	}else{
		return $request->getHeaders()['X-Forwarded-For'][0];
	}
}

function gg($info){
	$msg = '';
	$msg .= '<meta charset="UTF-8">';
	$msg .= '<pre>';
	$msg .= 'motd: ' . $info["HostName"] . "\n";
	$msg .= 'version: ' . $info["Version"] . "\n";
	$plugins = implode(',<br>', $info["Plugins"]);
	$msg .= 'plugins: ' . $plugins . "\n";
	$msg .= 'players: ' . $info["Players"] . "\n";
	$msg .= '</pre>';
	return $msg;
}

/*function is_ipv6($ip){
    if (!preg_match("/^([0-9a-f\.\/:]+)$/",strtolower($ip))) {
        return false;
    }

    if (substr_count($ip,":") < 2) {
        return false;
    }

    $part = preg_split("/[:\/]/", $ip);
    foreach ($part as $i) {
        if (strlen($i) > 4) {
            return false;
        }
    }

    return true;
}*/


$loop = React\EventLoop\Factory::create();

$server = new React\Http\Server(function(Psr\Http\Message\ServerRequestInterface $request){
	
	$path = $request->getUri()->getPath();
	$clear_path = '/' . implode('/', array_filter(explode('/', $path)));

	$ip_ban = new utils\DataManager('/root/web/datas/ip_ban.json', utils\DataManager::JSON);
	$db['ip_ban'] = $ip_ban->getAll();

	if (isset($db['ip_ban'][get_ip($request)])){
		return new React\Http\Response(
	        403,
	        array('Content-Type' => 'text/html'),
			'403'
	    );
	}

	/*if (!isset($request->getHeaders()["CDN-Loop"][0])){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			"<script>location.replace('https://mcbe.kr');</script>"
		);
	}*/
	
	if (isset(pathinfo($clear_path)['extension'])){
		if (pathinfo($clear_path)['extension'] == 'php' || pathinfo($clear_path)['extension'] == 'cgi'){
			echo getTime() . 'XSS 공격이 감지되어 ' . get_ip($request) . ' 가 밴처리 되었습니다' . "\n";

			$db['ip_ban'][get_ip($request)] = "true";

			$ip_ban->setAll($db['ip_ban']);
			$ip_ban->save();
			   
			return new React\Http\Response(
				403,
				array('Content-Type' => 'text/html'),
				'403'
			);
		}
	}

	if ($clear_path === '/'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		$a = [];
		exec("php /root/web/main.php", $a);

		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);
	}else if ($clear_path === '/upload' or $clear_path === '/upload/'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			file_get_contents('extractPhar/uploadFile.html')
		);
	}else if ($clear_path === '/uploads' && $request->getMethod() === "POST"){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		$file = $request->getUploadedFiles()['file'];
		if (isset(pathinfo($file->getClientFilename())['extension'])){
			if (pathinfo($file->getClientFilename())['extension'] == 'phar'){
				$stream = $file->getStream();
				file_put_contents('datas/plugins/' . $file->getClientFilename(), $stream->getContents());

				exec('php extractPhar/extractPhar.php ' . 'datas/plugins/' . $file->getClientFilename());

				return new React\Http\Response(
					200,
					array('Content-Type' => 'text/html'),
					'download...'
				);
			}else{
				return new React\Http\Response(
					200,
					array('Content-Type' => 'text/html'),
					'only phar... false'
				);
			}
		}
	}else if ($clear_path === '/plugin' or $clear_path === '/plugin/'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		$a = [];
		exec("php /root/web/plugin.php", $a);

		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);
	}else if ($clear_path === '/sitemap.xml'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/xml'),
			file_get_contents('sitemap.xml')
		);
	}else if ($clear_path === '/robots.txt'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/plain'),
			file_get_contents('robots.txt')
		);
	}else if ($clear_path === '/count_ranking' && $request->getMethod() === "GET"){
		$page = '';
		if (isset($request->getQueryParams()['page']) and is_numeric($request->getQueryParams()['page'])){
			$page = $request->getQueryParams()['page'];
		}else{
			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				"<script>location.replace('/count_ranking?page=1');</script>"
			);
		}
		echo ip_log($request) . ' - URL: ' . $clear_path . '?page=' . $page . "\n";
		$a = [];
		exec("php /root/web/count_ranking.php {$page}", $a);

		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);
	}else if ($clear_path === '/good_ranking' && $request->getMethod() === "GET"){
		$page = '';
		if (isset($request->getQueryParams()['page']) and is_numeric($request->getQueryParams()['page'])){
			$page = $request->getQueryParams()['page'];
		}else{
			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				"<script>location.replace('/good_ranking?page=1');</script>"
			);
		}
		echo ip_log($request) . ' - URL: ' . $clear_path . '?page=' . $page . "\n";
		$a = [];
		exec("php /root/web/good_ranking.php {$page}", $a);
	
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);
	}else if ($clear_path === '/search' or $clear_path === '/search/'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			file_get_contents('query/search.html')
	    );
	}else if ($clear_path === '/add' or $clear_path === '/add/'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			file_get_contents('add/add.html')
		);
	/*}else if ($clear_path === '/good' or $clear_path === '/good/'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			file_get_contents('good/menu.html')
		);*/
	}else if ($clear_path === '/favicon.ico'){
		echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/x-icon'),
			file_get_contents('images/favicon.ico')
		);
	}else if ($clear_path === '/img_not'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/img_not.jpg')
		);
	}else if ($clear_path === '/mcbe_logo'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/mcbe_logo.jpg')
		);
	}else if ($clear_path === '/server_properties'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/server.jpg')
		);
	}else if ($clear_path === '/flat_sv'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/flat_sv.jpg')
		);
	}else if ($clear_path === '/taon_sv'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/taon_sv.jpg')
		);
	}else if ($clear_path === '/rp_cloud'){
		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/rp_cloud.jpg')
	    );
	}else if ($clear_path === '/kk_cafe'){
		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'image/jpeg'),
			file_get_contents('images/kk_cafe.jpg')
	    );
	}else if ($clear_path === '/not_enroll'){
		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			file_get_contents('warning/url_not_enroll.html')
		);
	}else if ($clear_path === '/query' && $request->getMethod() === "POST"){
		$ip = htmlspecialchars($request->getParsedBody()['ip'], ENT_QUOTES, 'UTF-8');
		if (empty($ip)){
			echo getTime() . ' 조회 실패 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				file_get_contents('query/search.html')
			);
		}
		$query = new \MinecraftQuery();
		$query->connect($ip, 19132);

		if($query->isOnline()){
			$info = $query->getInfo();
			echo getTime() . $ip . ' 조회 성공 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";
			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				gg($info)
			);
		}else{
			echo getTime() . $ip . ' 조회 실패 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";
			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				"false"
			);
		}
	}else if ($clear_path === '/adds' && $request->getMethod() === "POST"){
		$ip = htmlspecialchars($request->getParsedBody()['ip'], ENT_QUOTES, 'UTF-8');
		$port = htmlspecialchars($request->getParsedBody()['port'], ENT_QUOTES, 'UTF-8');
		$ip_c = strtolower($ip);
		$addManager = new \AddManager();

		if ((empty($ip) and empty($port)) or (empty($ip) or empty($port))){
			echo getTime() . '추가 실패 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				file_get_contents('add/motd_fail.html')
			);
		}else{
			if (strpos($ip_c, 'kr') !== false or strpos($ip_c, 'am') !== false or strpos($ip_c, 'xyz') !== false or strpos($ip_c, 'world') !== false){
				$motd = $addManager->getMOTD($ip_c, $port);
				var_dump($motd);
				if ($motd == 'MCBE'){
					$server_list = new utils\DataManager('/root/web/datas/list.json', utils\DataManager::JSON);
					$db['server'] = $server_list->getAll();

					foreach($db['server'] as $servers => $type){

						$a_ip = $type['address'];
						$p_ort = $type['port'];

						//var_dump($a_ip . ':' . $p_ort);

						if ($a_ip === $ip_c and $p_ort == $port){

							echo getTime() . $ip_c . ':' . $port . ' 추가 실패 - ADD_ALRADY | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

							return new React\Http\Response(
								200,
								array('Content-Type' => 'text/html'),
								file_get_contents('add/add_already_fail.html')
							);
						}
					}
					$addServer = [];
					$addServer['address'] = $ip_c;
					$addServer['port'] = $port;
					$addServer['band'] = '';
					$addServer['kakao'] = '';
					$db['server'][] = $addServer;

					$server_list->setAll($db['server']);
					$server_list->save();

					echo getTime() . $ip_c . ':' . $port . ' 추가 성공 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

					return new React\Http\Response(
						200,
						array('Content-Type' => 'text/html'),
						file_get_contents('add/add_success.html')
					);
				}else{
					echo getTime() . $ip_c . ':' . $port . ' 추가 실패 - MOTD FAIL | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";
					return new React\Http\Response(
						200,
						array('Content-Type' => 'text/html'),
						file_get_contents('add/motd_fail.html')
					);
				}
			}else{
				echo getTime() . $ip_c . ':' . $port . ' 추가 실패 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

				return new React\Http\Response(
					200,
					array('Content-Type' => 'text/html'),
					file_get_contents('add/add_domain_fail.html')
				);
			}
		}
	}else if ($clear_path === '/good' && $request->getMethod() === "GET"){
		$ip = '';
		$port = '';
		$name = '';
		if (isset($request->getQueryParams()['ip']))
			$ip .= htmlspecialchars($request->getQueryParams()['ip'], ENT_QUOTES, 'UTF-8');
		if (isset($request->getQueryParams()['port']))
			$port .= htmlspecialchars($request->getQueryParams()['port'], ENT_QUOTES, 'UTF-8');
		if (isset($request->getQueryParams()['name']))
			$name .= htmlspecialchars($request->getQueryParams()['name'], ENT_QUOTES, 'UTF-8');


		if (file_get_contents('http://ip-api.com/php/' . $request->getHeaders()['X-Forwarded-For'][0] . '?fields=mobile') == 'a:1:{s:6:"mobile";b:1;}'){
			echo getTime() . '추천 실패 - IP_MOBILE | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				file_get_contents('good/ip_mobile_fail.html')
			);
		}

		if (file_get_contents('http://ip-api.com/php/' . $request->getHeaders()['X-Forwarded-For'][0] . '?fields=countryCode') != 'a:1:{s:11:"countryCode";s:2:"KR";}'){
			echo getTime() . '추천 실패 - IP_KR | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				file_get_contents('good/ip_kr_fail.html')
			);
		}

		if ((empty($ip) and empty($port) and empty($name)) or (empty($ip) or empty($port) or empty($name))){
			$a = [];
			exec("php /root/web/good/add.php {$ip} {$port} {$name}", $a);

			return new React\Http\Response(
		        200,
		        array('Content-Type' => 'text/html'),
				implode("\n", $a)
		    );
		}else{
			$good = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
		    $db['good'] = $good->getAll();

			$l = new utils\DataManager('/root/web/datas/ip.json', utils\DataManager::JSON);
		    $db['ip'] = $l->getAll();

			if (isset($db['ip']['ip'][$request->getHeaders()['X-Forwarded-For'][0]])){
				echo getTime() . $ip . ':' . $port . ':' . strtolower($name) . ' 추천 실패 - IP_ALREADY | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

				return new React\Http\Response(
			        200,
			        array('Content-Type' => 'text/html'),
					file_get_contents('good/ip_already_fail.html')
			    );
			}

			if (isset($db['good'][$ip . ':' . $port]['players'][strtolower($name)])){
				echo getTime() . $ip . ':' . $port . ':' . strtolower($name) . ' 추천 실패 - ADD_ALREADY | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

				return new React\Http\Response(
			        200,
			        array('Content-Type' => 'text/html'),
					file_get_contents('good/add_already_fail.html')
			    );
			}else{
				echo getTime() . $ip . ':' . $port . ':' . strtolower($name) . ' 추천 완료 | ' . '[Client IP: ' . $request->getHeaders()['X-Forwarded-For'][0] . '/' . $request->getServerParams()['REMOTE_PORT'] . ']' . "\n";

				$db['good'][$ip . ':' . $port]['status'] = 'true';
				$db['good'][$ip . ':' . $port]['players'][strtolower($name)] = date('Y-m-d-H-i-s');

				$db['ip']['ip'][$request->getHeaders()['X-Forwarded-For'][0]] = $ip . ':' . $port;

				$good->setAll($db['good']);
			    $good->save();

				$l->setAll($db['ip']);
			    $l->save();

				return new React\Http\Response(
			        200,
			        array('Content-Type' => 'text/html'),
					file_get_contents('good/add_success.html')
			    );
			}
		}
	}else if ($clear_path === '/good_json' && $request->getMethod() === "GET"){
		$ip = '';
		$port = '';
		if (isset($request->getQueryParams()['ip']))
			$ip .= htmlspecialchars($request->getQueryParams()['ip'], ENT_QUOTES, 'UTF-8');
		if (isset($request->getQueryParams()['port']))
			$port .= htmlspecialchars($request->getQueryParams()['port'], ENT_QUOTES, 'UTF-8');

		$a = [];
		exec("php /root/web/good/json.php {$ip} {$port}", $a);

		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			implode("\n", $a)
	    );
	}else if ($clear_path === '/server' && $request->getMethod() === "GET"){
		$ip = htmlspecialchars($request->getQueryParams()['ip'], ENT_QUOTES, 'UTF-8');
		$port = htmlspecialchars($request->getQueryParams()['port'], ENT_QUOTES, 'UTF-8');
		
		if ((empty($ip) and empty($port)) or (empty($ip) or empty($port))){
			return new React\Http\Response(
				200,
				array('Content-Type' => 'text/html'),
				"<script>location.replace('/');</script>"
			);
		}

		echo ip_log($request) . ' - URL: ' . $clear_path . '?ip=' . $ip . '&port=' . $port . "\n";

		$a = [];
		exec("php /root/web/newServer.php {$ip} {$port}", $a);

		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);
	/*}else if ($clear_path === '/api_json'){
		$a = [];
		exec("php /root/web/api.php ", $a);

		return new React\Http\Response(
			200,
			array('Content-Type' => 'text/html'),
			implode("\n", $a)
		);*/
	}else{
		echo ip_log($request) . "\n";
		var_dump($clear_path);

		$log_txt = ip_log($request) . ' | URL: ' . $clear_path;
		$log_file = fopen(__DIR__ . '/log.txt', 'a');

		fwrite($log_file, $log_txt . "\r\n");

		fclose($log_file);

		/*$a = [];
		exec("php /root/web/new.php", $a);

		return new React\Http\Response(
	        200,
	        array('Content-Type' => 'text/html'),
			implode("\n", $a)
	    );*/
		return new React\Http\Response(
			404,
			array('Content-Type' => 'text/html'),
			file_get_contents('warning/system_url.html')
		);
	}
});


$socket = new React\Socket\Server("0.0.0.0:80", $loop);
$server->listen($socket);

echo "START\n";

$loop->run();

?>
