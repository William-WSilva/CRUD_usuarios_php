<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$id = filter_input(INPUT_GET, 'id'); // capturando a chave id na url com o valor ID
if($id){
    $usuarioDao->delete($id);
}
header("Location: index.php");
exit;