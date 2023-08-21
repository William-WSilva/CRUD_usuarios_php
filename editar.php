<?php
require 'config.php';
require 'dao/UsuarioDaoMysql.php';

$usuarioDao = new UsuarioDaoMysql($pdo);

$usuario = false;
$id = filter_input(INPUT_GET, 'id'); // capturando a chave id na url com o valor ID

if($id){
    $usuario = $usuarioDao->findById($id);
}
if($usuario === false){
    header("Location: index.php");
    exit;
}

?>
<h1>Editar Usuário</h1>
<form method="POST" action="editar_action.php" >
    <input type="hidden" name="id" value="<?=$usuario->getId();?>">
    <label for="name">
        Nome:</br>
        <input type="text" name="name" value="<?=$usuario->getNome();?>" />
    </label></br></br>
    <label for="email">
        Email:</br>
        <input type="email" name="email" value="<?=$usuario->getEmail();?>">
    </label></br></br>
    <input type="submit" value="Salvar"/>
</form>