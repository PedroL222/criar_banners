<?php
session_start();
ob_start();
include_once '../config.php';


$email_l_usu = $_POST['email_l_usu'];
$senha_l_usu = $_POST['senha_l_usu'];

$query_usuario = "SELECT * FROM T_usuario WHERE email_usu = :email_l_usu";
$reslog = $dbh->prepare($query_usuario);
$reslog->bindParam(':email_l_usu', $email_l_usu, PDO::PARAM_STR);


$reslog->execute();

if(($reslog) && $reslog->rowCount() != 0){
    $linhalog = $reslog->fetch(PDO::FETCH_ASSOC);
    

    if($senha_l_usu == $linhalog['senha_usu']){
        $_SESSION['id'] = $linhalog['idT_usuario'];
        $_SESSION['nome'] = $linhalog['nome_usu'];

    }else{
        $_SESSION['msg'] = 'Erro: email_l_usu ou senha incorretos';
        header("Location: http://localhost/criar_banners/view/index.php");
    }

}else{
    $_SESSION['msg'] = 'Erro: email_l_usu ou senha incorretos';
    header("Location: http://localhost/criar_banners/view/index.php");
}

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

header("Location: http://localhost/criar_banners/view/criar_banner.php");
