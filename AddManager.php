<?php

class AddManager{

    public function getMOTD(string $ip, int $port){
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
        return $serverInfo[1];
    }
    
}
?>
