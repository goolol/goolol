<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
  </head>
<body>
<?php
   session_start();
include('includes/libs/db.php');
Connect();
$login = $_REQUEST["loginEnter"];
$password = $_REQUEST["passEnter"];
try{
  if (!isset($login))
    exit("Вы не ввели логин.");
  
  if (!isset($password))
    exit("Вы не ввели пароль.");
  
  $import = mysql_query("select * from users where login = '$login' and password = md5(sha1(md5('$password')))");
  if (!$import)
    exit("Пользователя с таким логином или паролем не существует.");
  else{
    $_SESSION["login"] = $login;
    echo "<meta http-equiv='Refresh' content='0; URL=account.php'>";
  }
} catch(Exeption $error){
  printf($error->getMessage());
}
?>
</body>
</html>