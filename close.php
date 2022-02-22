<?php

date_default_timezone_set('Asia/Seoul');

include "./vendor/autoload.php";

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


$loop = React\EventLoop\Factory::create();

$server = new React\Http\Server(function(Psr\Http\Message\ServerRequestInterface $request){
	
	$path = $request->getUri()->getPath();
	$clear_path = '/' . implode('/', array_filter(explode('/', $path)));
    
    echo ip_log($request) . ' - URL: ' . $clear_path . "\n";
    
    return new React\Http\Response(
	    200,
	    array('Content-Type' => 'text/html'),
        file_get_contents('close.html')
    );
    
});


$socket = new React\Socket\Server("0.0.0.0:80", $loop);
$server->listen($socket);

echo "START\n";

$loop->run();

?>
