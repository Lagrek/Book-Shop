<?php 

  if(isset($_POST['Name'])) $Name = $_POST['Name'];
  if (isset($_POST['Email'])) $Email = $_POST['Email'];
  if (isset($_POST['Password'])) $Password = $_POST['Password'];

  $host = '127.0.0.1';
  $db   = 'bookshop';
  $user = 'root';
  $pass = '';
  $charset = 'utf8';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);


$pattern_Name = "/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/";
$pattern_Email = "/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/";
$pattern_Password = "/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/";

if(!preg_match($pattern_Name, $Name)){
echo 'Имя введено неверно!';
}
else{
    if(!preg_match($pattern_Email, $Email)){
    echo 'Почта введена неверно!';
}
else{
    if(!preg_match($pattern_Password, $Password)){
    echo 'Пароль введён неверно!';
}
else{

$mysql = "INSERT INTO  shopbook (Name,Email,Password) VALUES(:Name,:Email,:Password)";
$q = $pdo->prepare($mysql);
$q->execute(array(':Name'=>$Name,
                  ':Email'=>$Email,
                  ':Password'=>$Password,));
}
}
}


 ?>

