<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mpl";

$connect=new mysqli($servername,$username,$password,$dbname);
echo "connected sucessfull";
if($connect->connect_error)
{
die("connection fails".$connect->connect_error);
}
?>
