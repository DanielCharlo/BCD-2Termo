<?php

$db = "OFICINA";
$host = "localhost";
$user = "root";
$key = "Charlo2025@";

$con = new mysqli($host,$user,$key,$db);

if ($con->connect_error) {
    echo "Erro na conexão com banco de dados";
} 

?>