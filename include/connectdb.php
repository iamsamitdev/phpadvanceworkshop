<?php 

$host 			= "localhost";
$username_db 	= "root";
$password_db 	= "1234";
$dbname 		= "advancedb";

$connect = mysqli_connect($host,$username_db,$password_db,$dbname);
mysqli_set_charset($connect,"utf8");

if(mysqli_connect_errno())
{
	echo mysqli_connect_error();
}else{
	//echo "Connnect database success";
}

?>