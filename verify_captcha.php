<?php
 
if (isset($_POST['token']) && isset($_POST['action'])) {
    $captcha_token = $_POST['token'];
    $captcha_action = $_POST['action'];
} else {
    die('Капча работает некорректно. Обратитесь к администратору!');
}
 
$url = 'https://www.google.com/recaptcha/api/siteverify';
$params = [
    'secret' => '6LfVX50UAAAAAKb8i-nnWwts7eldrpHD86dX_ApL',
    'response' => $captcha_token,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
$response = curl_exec($ch);
if(!empty($response)) $decoded_response = json_decode($response);
 
$success = false;
 
if ($decoded_response && $decoded_response->success && $decoded_response->action == $captcha_action && $decoded_response->score > 0) {
    $success = $decoded_response->success;
    // обрабатываем данные формы, которая защищена капчей
} else {
    // прописываем действие, если пользователь оказался ботом
}
 
echo json_encode($success);?>