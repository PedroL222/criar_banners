<?php

include_once '../config.php';

// Credênciais do usuário


$nome_ban = $_POST['nome_ban'];
$link_ban = $_POST['link_ban'];
$img_ban = $_POST['img_ban'];
$texto_ban = $_POST['texto_ban'];


//Verificando se a conta já existe

$sql = $dbh ->prepare("SELECT * FROM T_banner WHERE nome_ban = '$nome_ban'");
$sql->execute();

$res = $sql->rowCount();
    if($res==null){

// Inserindo informações no banco

        $sql1 = $dbh->prepare("INSERT INTO T_banner (idT_banner,nome_ban,link_ban,img_ban,status_ban,texto_ban)" . "VALUES(null,'$nome_ban',:link_ban,:texto_ban)");
        $sql1->execute(Array(
        ':nome_ban' => $nome_ban,
        ':link_ban' => $link_ban,
        ':texto_ban' => $texto_ban,
        ));
        header("Location: http://localhost/criar_banners/view/index.php");
    }else{
        header("Location: http://localhost/criar_banners/view/registrar_usu.php");
    }


//Voltando a página de registro

header("Location: http://localhost/criar_banners/view/registrar_usu.php");

?>