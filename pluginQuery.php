<?php

require './utils/DataManager.php';

require './query/Query/MinecraftQuery.php';

while(true){

    /** SERVER LIST DATA */
    $server_list = new utils\DataManager('/root/web/datas/list.json', utils\DataManager::JSON);
    $db['server_list'] = $server_list->getAll();

    /** PLUGIN DATA */
    $plugin_data = new utils\DataManager('/root/web/datas/plugin.json', utils\DataManager::JSON);
    $db['plugin_data'] = $plugin_data->getAll();

    $db['plugin_data'] = [];

    $count = 0;

    foreach ($db['server_list'] as $servers => $type){
        $query = new \MinecraftQuery();
        $query->connect($type['address'], $type['port']);

        if ($query->isOnline()){

            $count++;

            foreach ($query->getInfo()['Plugins'] as $key => $value){

                $info = explode(' ', $value);

                if (!isset($db['plugin_data']['plugins'][$info[0]])){
                    $db['plugin_data']['plugins'][$info[0]] = [];
                    $db['plugin_data']['plugins'][$info[0]][$info[1]] = 0;
                }

                if (!isset($db['plugin_data']['plugins'][$info[0]][$info[1]])){
                    $db['plugin_data']['plugins'][$info[0]][$info[1]] = 0;
                }
    
                $db['plugin_data']['plugins'][$info[0]][$info[1]]++;
                
            }

            echo '- ' . $type['address'] . ', 수집 완료' . "\n";

        }else{

            echo '- ' . $type['address'] . ', 수집 실패' . "\n";
        
        }

    }

    echo '- 데이터 수집이 완료 되었습니다..' . "\n";

    $db['plugin_data']['count'] = $count;

    $plugin_data->setAll(mb_convert_encoding($db['plugin_data'], 'UTF-8', 'UTF-8'));
    $plugin_data->save();

    sleep(60);

}

?>