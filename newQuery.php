<?php

require './utils/DataManager.php';

date_default_timezone_set('Asia/Seoul');

$allcount = 0;

$db = [];
$api = [];
$dailyCount;

$graph = [];

while(true){

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
    $server_data = new utils\DataManager('/root/web/datas/server_new.json', utils\DataManager::JSON);
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

            $server[$ip . ':' . $port] = [];
            $server[$ip . ':' . $port]['status'] = 'on';
            $server[$ip . ':' . $port]['ip'] = gethostbyname($ip); // IP
            $server[$ip . ':' . $port]['motd'] = htmlspecialchars($result[1]); // MOTD
            $server[$ip . ':' . $port]['player-num'] = $result[4]; // COUNT
            if (!isset($dailyCount[$ip . ':' . $port])){
                $dailyCount[$ip . ':' . $port] = '0';
            }
            $server[$ip . ':' . $port]['daily-num'] = $dailyCount[$ip . ':' . $port]; // BEST COUNT
            if (!isset($db['good'][$ip . ':' . $port]['players'])){
                $server[$ip . ':' . $port]['good-num'] = '0';
            }else{
                $server[$ip . ':' . $port]['good-num'] = (string) count($db['good'][$ip . ':' . $port]['players']); // RECOMMEND COUNT
            }
            $server[$ip . ':' . $port]['version'] = $result[3]; // VERSION
            $server[$ip . ':' . $port]['engine'] = $result[7]; // ENGINE
            $server[$ip . ':' . $port]['band'] = $band; // BAND LINK
            $server[$ip . ':' . $port]['kakao'] = $kakao; // KAKAO_PLUS LINK
            //$server[$ip . ':' . $port]['count-rank'] = '0'; // COUNT RANKING NUM
            //$server[$ip . ':' . $port]['good-rank'] = '0'; // GOOD RANKING NUM

            if (!isset($dailyCount[$ip . ':' . $port])){
                $dailyCount[$ip . ':' . $port] = $result[4];
            }

            if ($result[4] > $dailyCount[$ip . ':' . $port]){
                $dailyCount[$ip . ':' . $port] = $result[4];
            }

            $allcount += $result[4];

        }else{

            $server[$ip . ':' . $port] = [];
            $server[$ip . ':' . $port]['status'] = 'off';
            $server[$ip . ':' . $port]['ip'] = gethostbyname($ip); // IP
            $server[$ip . ':' . $port]['motd'] = 'false'; // MOTD
            $server[$ip . ':' . $port]['player-num'] = '0'; // COUNT
            if (!isset($dailyCount[$ip . ':' . $port])){
                $dailyCount[$ip . ':' . $port] = '0';
            }
            $server[$ip . ':' . $port]['daily-num'] = $dailyCount[$ip . ':' . $port]; // BEST COUNT
            if (!isset($db['good'][$ip . ':' . $port]['players'])){
                $server[$ip . ':' . $port]['good-num'] = '0';
            }else{
                $server[$ip . ':' . $port]['good-num'] = (string) count($db['good'][$ip . ':' . $port]['players']); // RECOMMEND COUNT
            }
            $server[$ip . ':' . $port]['version'] = 'false'; // VERSION
            $server[$ip . ':' . $port]['engine'] = 'false'; // ENGINE
            $server[$ip . ':' . $port]['band'] = $band; // BAND LINK
            $server[$ip . ':' . $port]['kakao'] = $kakao; // KAKAO_PLUS LINK
            //$server[$ip . ':' . $port]['count-rank'] = '0'; // COUNT RANKING NUM
            //$server[$ip . ':' . $port]['good-rank'] = '0'; // GOOD RANKING NUM

        }
    }

    $db['server_data']['date'] = date('Y년 m월 d일 H시 i분');
    $db['server_data']['allcount'] = $allcount;

    /**
     *
     * PLAYER SORT_DESC START
     *
     */

    $sort_count = [];

    foreach($server as $key => $value){
        $sort_count[$key] = $value['player-num'];
    }

    array_multisort($sort_count, SORT_DESC, $server);

    $db['server_data']['count-ranking'] = [];
    $db['server_data']['count-ranking'] = $server;

    /**
     *
     * PLAYER SORT_DESC END
     *
     */

    /**
     *
     * GOOD SORT_DESC START
     *
     */

    $sort_good = [];

    foreach($server as $key => $value){
        $sort_good[$key] = $value['good-num'];
    }

    array_multisort($sort_good, SORT_DESC, $server);

    $db['server_data']['good-ranking'] = [];
    $db['server_data']['good-ranking'] = $server;

    /**
     *
     * GOOD SORT_DESC END
     *
     */

    echo '날짜 : ' . date('Y년 m월 d일 H시 i분') . "\n";
    echo '한국 BE 서버 전체 접속자 : ' . $allcount . ' 명' . "\n";

    $count_rank = 0;

    foreach($db['server_data']['count-ranking'] as $key => $value){
        $count_rank++;

        $db['server_data']['count-ranking'][$key]['count-rank'] = (string) $count_rank;

        $db['graph'][$key][] = date('H') . '_' . date('i') . ':' . $value['player-num'];

        echo $count_rank . '위 - ' . $key . ' - 동접 - ' . $value['player-num'] . '명 - 상태 - ' . $value['status'] . "\n";
    }

    $good_rank = 0;

    foreach($db['server_data']['good-ranking'] as $key => $value){
        $good_rank++;

        $db['server_data']['good-ranking'][$key]['good-rank'] = (string) $good_rank;

        //echo $rank . '위 - ' . $key . ' - 동접 - ' . $value['player-num'] . '명 - 상태 - ' . $value['status'] . "\n";
    }

    //$db['api']['status'] = 'true';
    //$db['api']['date'] = date('Y-m-d-H-i');
    //$db['api']['servers'] = $a;

    //$server_api->setAll($db['api']);
    //$server_api->save();
    
    $server_data->setAll(mb_convert_encoding($db['server_data'], 'UTF-8', 'UTF-8'));
    $server_data->save();

    $server_graph->setAll($db['graph']);
    $server_graph->save();

    $allcount = 0;
    //unset($server);

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
