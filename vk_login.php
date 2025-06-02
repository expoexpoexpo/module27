<?php
session_start();

$client_id = '53670082';
$redirect_uri = 'https://gans4o-89-232-95-168.ru.tuna.am/module_27/vk_callback.php';
$scope = 'email';
$response_type = 'code';
$state = bin2hex(random_bytes(8));

$_SESSION['vk_oauth_state'] = $state;

$auth_url = "https://oauth.vk.com/authorize?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => $scope,
    'response_type' => $response_type,
    'state' => $state,
    'v' => '5.131',
]);

header("Location: $auth_url");
exit;
