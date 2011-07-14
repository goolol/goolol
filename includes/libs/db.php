<?php
function Connect(){
  $db = mysql_connect ("localhost","snakeduse","123456");
  mysql_select_db("gulol",$db);
}
?>