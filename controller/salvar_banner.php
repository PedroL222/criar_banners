<?php

include_once("../config.php");

$img_ban = "";
$nome_ban = $_POST['nome_ban'];
$link_ban = $_POST['link_ban'];
$texto_ban = $_POST['texto_ban'];
$status_ban = 0;

$id_usuario = $_POST['id'];

if(isset($_FILES['arquivo'])){

    $arquivo = $_FILES['arquivo'];

    $pasta = "../arquivos/";

    $arquivo = $_FILES['arquivo'];
    if($arquivo['size']>2097000){
        die("arquivo muito grande max 2mb");
    }
    $nomeArquivo = $arquivo['name'];

    $novoNomeArquivo = uniqid();

    $extensao = strtolower(pathinfo($nomeArquivo,PATHINFO_EXTENSION));

    if($extensao != "jpg" && $extensao != "png" && $extensao != ""){
        die();
    }

    $path = $pasta . $novoNomeArquivo . "." . $extensao;

    echo $path;

    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path );

    if($deu_certo){
        $img_ban = $path;
        //Verificando se a conta já existe

        $sql = $dbh ->prepare("SELECT * FROM T_banner WHERE nome_ban = '$nome_ban'");
        $sql->execute();

        $res = $sql->rowCount();
            if($res==null){

        // Inserindo informações no banco

        $sql1 = $dbh->prepare("INSERT INTO T_banner (idT_banner,nome_ban,link_ban,img_ban,status_ban,texto_ban,T_usuario_idT_usuario)" . "VALUES(null,'$nome_ban','$link_ban','$img_ban','$status_ban','$texto_ban','$id_usuario')");
        $sql1->execute();
        header("Location: http://localhost/criar_banners/view/criar_banner.php");
    }else{
        header("Location: http://localhost/criar_banners/view/registrar_usu.php");
    }
    }else{
        $img_ban = "";

        //Verificando se a conta já existe

        $sql = $dbh ->prepare("SELECT * FROM T_banner WHERE nome_ban = '$nome_ban'");
        $sql->execute();

        $res = $sql->rowCount();
            if($res==null){

        // Inserindo informações no banco

                $sql1 = $dbh->prepare("INSERT INTO T_banner (idT_banner,nome_ban,link_ban,img_ban,status_ban,texto_ban,T_usuario_idT_usuario)" . "VALUES(null,'$nome_ban','$link_ban','$img_ban','$status_ban','$texto_ban','$id_usuario')");
                $sql1->execute();
                header("Location: http://localhost/criar_banners/view/criar_banner.php");
            }else{
                header("Location: http://localhost/criar_banners/view/registrar_usu.php");
            }
    }

}







//Voltando a página de registro

header("Location: http://localhost/criar_banners/view/criar_banner.php");

?>