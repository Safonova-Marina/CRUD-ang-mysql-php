<?
/* 
	Подключаемый модульconnect.inc.php - подключения к базе данных
	Логин:  "root" 
	Пароль:  ""
	База:  "books" 
*/ 
$host = "localhost";
$db_login = "root";
$db_pass = "";
$db_source = "users";

mysql_connect($host, $db_login, $db_pass) or die ("He могу подключиться к серверу!"); 
mysql_select_db($db_source) or die ("He могу подключиться к базе данных!"); 

//-- Установка кодовой таблицыWin-1251 
mysql_query("SET NAMES 'utf-8'"); 
mysql_query("SET CHARACTER SET 'utf-8'"); 

?>