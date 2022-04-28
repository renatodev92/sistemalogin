<?php 
//Conexão com o banco de dados.

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "sistemalogin";

$connect    = mysqli_connect($servername, $username, $password, $dbname);

if(mysqli_connect_error()):
    echo "Falha na conexão com o bando de dados.".mysqli_connect_error();
endif;

?>