<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  </head>
<body>
<?php
   session_start();
include('includes/libs/db.php');
Connect();
$login = $_REQUEST['login'];
$name = $_REQUEST['name'];
$surname = $_REQUEST['surname'];
$age = $_REQUEST['age'];
$password = $_REQUEST['pass'];
$rePassword = $_REQUEST['repass'];
try{
  if(!isset($login))
    exit("Вы не заполнили поле логина.");

  if(!isset($name))
    exit("Вы не заполнили поле имени.");

  if(!isset($surname))
    exit("Вы не заполнили поле фамилии.");

  if(!isset($age))
    exit("Вы не заполнили поле возраста.");

  if(!isset($password))
    exit("Вы не заполнили поле пароля.");

  if(!isset($rePassword))
    exit("Вы не заполнили поле повторение пароля.");

  if(strlen($login) > 30)
    exit("Логин больше 30 символов.");

  if(strlen($name) > 100)
    exit("Имя больше 100 символов.");

  if(strlen($surname) > 100)
    exit("Фамилия больше 100 символов.");

  if(strlen($age) > 150)
    exit("Ваш возраст больше 150 лет, в России столько не живут.");

  if($password != $rePassword)
    exit("Введенные вами пароли ароли не совпадают.");
  
  if (strlen($password) < 6)
    exit("Длина пароля меньше 6 символов");

  if (strlen($password) > 400)
    exit("Пароль больше 400 символов.");
  
  $import = mysql_query("SELECT * FROM users WHERE login = '$login'") or die(mysql_error());
  if(!$import)
    exit("Невозможно подключиться к базе данных. Пожалуйста, попробуйте позже.");
  else{
    $objects = mysql_fetch_object($import);
    if($login == $objects->login)
      exit("Данный логин занят кем-то другим, выберите другой.");
    else{
      $date = date("l dS F Y h:i:s A");
      $addUser = mysql_query("INSERT INTO users (login, name, surname, age, password, date) VALUES ('$login', '$name', '$surname', '$age', md5(sha1(md5('$password'))), '$date')") or die(mysql_error());
      if($addUser){
	$_SESSION["login"] = $login;
	echo "<meta http-equiv='Refresh' content='0; URL=account.php'>";
      } else{
	exit("Простите, но по неизвестным нам причинам, вы не можете сейчас зарегистрироваться. Попробуйте позже.");
      }
    }
  }
} 
catch (Exeption $error){
  printf($error->getMessage());
  }
?>
 </body>
</html>