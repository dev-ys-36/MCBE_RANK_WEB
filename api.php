<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

include './utils/DataManager.php';

$server_api = new utils\DataManager('/root/web/datas/api.json', utils\DataManager::JSON);
$db['api'] = $server_api->getAll();

echo '<pre>';
echo json_encode($db['api'], JSON_PRETTY_PRINT);
echo '</pre>';

?>
</body>
</html>
