<?php

include_once '../config.php';

// Credênciais do usuário

$nome_r_usu = $_POST['nome_r_usu'];
$email_r_usu = $_POST['email_r_usu'];
$senha_r_usu = $_POST['senha_r_usu'];

//Verificando se a conta já existe

$sql = $dbh ->prepare("SELECT * FROM T_usuario WHERE email_usu = '$email_r_usu'");
$sql->execute();

$res = $sql->rowCount();
    if($res==null){

// Inserindo informações no banco

        $sql1 = $dbh->prepare('INSERT INTO T_usuario (idT_usuario,nome_usu,email_usu,senha_usu)' . 'VALUES(null,:nome_r_usu,:email_r_usu,:senha_r_usu)');
        $sql1->execute(Array(
        ':nome_r_usu' => $nome_r_usu,
        ':email_r_usu' => $email_r_usu,
        ':senha_r_usu' => $senha_r_usu,
        ));
        header("Location: http://localhost/criar_banners/view/index.php");
    }else{
        header("Location: http://localhost/criar_banners/view/registrar_usu.php");
    }


//Voltando a página de registro

header("Location: http://localhost/criar_banners/view/registrar_usu.php");

?>