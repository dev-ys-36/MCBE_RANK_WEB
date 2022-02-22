<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

include './utils/DataManager.php';

$server_list = new utils\DataManager('/root/web/datas/good.json', utils\DataManager::JSON);
$db['good'] = $server_list->getAll();

if (isset($argv[1]) and isset($argv[2])){
    if (!isset($db['good'][$argv[1] . ':' . $argv[2]])){
        echo '<pre>';
        $array = [];
        $array['status'] = 'false';
        echo json_encode($array, JSON_PRETTY_PRINT);
        echo '</pre>';
    }else{
        echo '<pre>';
        echo json_encode($db['good'][$argv[1] . ':' . $argv[2]], JSON_PRETTY_PRINT);
        echo '</pre>';
    }
}else{
    echo '<pre>';
    $array = [];
    $array['status'] = 'false';
    echo json_encode($array, JSON_PRETTY_PRINT);
    echo '</pre>';
}
?>
</body>
</html>
