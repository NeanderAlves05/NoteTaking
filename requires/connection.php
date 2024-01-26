<?php
$server='localhost';
$db='notetaking';
$port='3306';
$username='root';
$password='';

$conn=new mysqli($server,$username,$password,$db,$port);
if($conn->error){
	echo "errore";
}else{

}

?>