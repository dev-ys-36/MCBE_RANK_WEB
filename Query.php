<?php

require './utils/DataManager.php';

date_default_timezone_set('Asia/Seoul');

$allcount = 0;
$rank = 0;

$db = [];
$api = [];
$dailyCount;

$online = [];
$offline = [];

$graph = [];

while(true){

    $online = [];
    $offline = [];

    /** SERVER API DATA */
    $server_api = new utils\DataManager('/root/web/datas/api.json', utils\DataManager::JSON);
    $db['api'] = $server_api->getAll();

    /** SERVER COUNT DATA */
    $server_graph = new utils\DataManager('/root/web/datas/graph.json', utils\DataManager::JSON);
    $db['graph'] = $server_graph->getAll();

    /** SERVER LIST DATA */
    $server_list = new utils\DataManager('/root/web/datas/list.json', utils\DataManager::JSON);
    $db['server_list'] = $server_list->getAll();

    /** SERVER RECOMMEND IP DATA */
    $good_ip = new utils\DataManager('/root/web/datas/ip.json', utils\DataManager::JSON);
    $db['good_ip'] = $good_ip->getAll();

    /** SERVER RECOMMEND DATA */
    $server_good = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
    $db['good'] = $server_good->getAll();

    /** SERVER DATA */
    $server_data = new utils\DataManager('/root/web/datas/server.json', utils\DataManager::JSON);
    $db['server_data'] = $server_data->getAll();

    unset($db['server_data']);


    // 매일 00시 00분 마다 graph.json 데이터를 초기화 합니다.

    if ((date('H') == '00' && date('i') == '00') or (date('H') == '00' && date('i') == '01')){

        foreach ($db['graph'] as $dd => $aa){

            unset($db['graph'][$dd]);

        }

        unset($db['good_ip']['ip']);

        $server_graph->setAll($db['graph']);
        $server_graph->save();

        $good_ip->setAll($db['good_ip']);
        $good_ip->save();

    }

    foreach($db['server_list'] as $servers => $type){
        $ip = $type['address'];
        $port = $type['port'];
        $band = $type['band'];
        $kakao = $type['kakao'];

        $result = getInfo($ip, $port);

        if ($result !== false){

            $online[$ip . ':' . $port] = [];
            $online[$ip . ':' . $port]['ip'] = gethostbyname($ip);
            $online[$ip . ':' . $port]['motd'] = $result[1];
            $online[$ip . ':' . $port]['numplayers'] = $result[4];
            $online[$ip . ':' . $port]['version'] = $result[3];
            $online[$ip . ':' . $port]['engine'] = $result[7];
            $online[$ip . ':' . $port]['band'] = $band;
            $online[$ip . ':' . $port]['kakao'] = $kakao;

            if (!isset($dailyCount[$ip . ':' . $port])){
                $dailyCount[$ip . ':' . $port] = $result[4];
            }

            if ($result[4] > $dailyCount[$ip . ':' . $port]){
                $dailyCount[$ip . ':' . $port] = $result[4];
            }

            $allcount += $result[4];

            unset ($offline[$ip . ':' . $port]);

        }else{

            $offline[$ip . ':' . $port] = [];
            $offline[$ip . ':' . $port]['numplayers'] = '0';

            unset ($online[$ip . ':' . $port]);

        }
    }

    echo '날짜 : ' . date('Y년 m월 d일 H시 i분') . "\n";
    echo '한국 BE 서버 전체 접속자 : ' . $allcount . ' 명' . "\n";

    $db['server_data']['date'] = date('Y년 m월 d일 H시 i분');
    $db['server_data']['allcount'] = $allcount;

    $ranking = [];
    foreach($online as $servers => $type){
        $ranking[$servers] = $online[$servers]['numplayers'];
    }
    arsort($ranking);

    foreach ($ranking as $servers => $type){
        ++$rank;
        $info = explode(':', $servers);
        printf($rank . ' 위 / ' . $info[0] . ' / ' . $online[$servers]['numplayers'] . ' 명 / 일일 최고 : ' . $dailyCount[$servers] . ' / 버전 : ' . $online[$servers]['version'] .  "\n");

        $on_sv = $rank . '_*_' . $info[0] . '_*_' . $info[1] . '_*_' . $online[$servers]['motd'] . '_*_' . $online[$servers]['numplayers'] . '_*_' . $dailyCount[$servers] . '_*_' . $online[$servers]['ip'] . '_*_' . $online[$servers]['engine'] . '_*_' . $online[$servers]['band'] . '_*_' . $online[$servers]['kakao'] . '_*_' . $online[$servers]['version'];
        $db['server_data']['online-server'][] = $on_sv;


        $db['graph'][$info[0] . ':' . $info[1]][] = date('H') . '_' . date('i') . ':' . $online[$servers]['numplayers'];

        if (isset($db['good'][$info[0] . ':' . $info[1]])){
            $a[] = [
                'domain' => $info[0],
                'ip' => $online[$servers]['ip'],
                'port' => $info[1],
                'rank' => $rank,
                'count' => $online[$servers]['numplayers'],
                'good' => $db['good'][$info[0] . ':' . $info[1]]['players']
            ];
        }else{
            $a[] = [
                'domain' => $info[0],
                'ip' => $online[$servers]['ip'],
                'port' => $info[1],
                'rank' => $rank,
                'count' => $online[$servers]['numplayers'],
                'good' => []
            ];
        }
    }

    foreach ($offline as $servers => $type){
        printf('- 위 / ' . explode(':', $servers)[0] . "\n");
        $db['server_data']['offline-server'][] = '-__' . explode(':', $servers)[0] . '__' . explode(':', $servers)[1];
    }

    $db['api']['status'] = 'true';
    $db['api']['date'] = date('Y-m-d-H-i');
    $db['api']['servers'] = $a;

    $server_api->setAll($db['api']);
    $server_api->save();

    $server_data->setAll($db['server_data']);
    $server_data->save();

    $server_graph->setAll($db['graph']);
    $server_graph->save();

    $allcount = 0;
    $rank = 0;

    sleep(30);
}

function getInfo(string $ip, int $port){
    $timeout = 4;
    $socket = @fsockopen ( 'udp://' . $ip, $port, $errno, $errstr, $timeout );
    if (!$socket)
    return false;
    stream_Set_Timeout ( $socket, $timeout );
    stream_Set_Blocking ( $socket, true );
    $randInt = mt_rand ( 1, 999999999 );
    $reqPacket = "\x01";
    $reqPacket .= pack ( 'Q*', $randInt );
    $reqPacket .= "\x00\xff\xff\x00\xfe\xfe\xfe\xfe\xfd\xfd\xfd\xfd\x12\x34\x56\x78";
    $reqPacket .= pack ( 'Q*', 0 );
    fwrite ( $socket, $reqPacket, strlen ( $reqPacket ) );
    $response = fread ( $socket, 4096 );
    fclose ( $socket );
    if (empty ( $response ) or $response === false) {
        return false;
    }
    if (substr ( $response, 0, 1 ) !== "\x1C") {
        return false;
    }
    $serverInfo = substr ( $response, 35 );
    $serverInfo = preg_replace ( "#§.#", "", $serverInfo );
    $serverInfo = explode ( ';', $serverInfo );
    return $serverInfo;
}

?>
