<?php

include_once("../config.php");

$img_ban = "";
$nome_ban = $_POST['nome_ban'];
$link_ban = $_POST['link_ban'];
$texto_ban = $_POST['texto_ban'];
$status_ban = 0;

$id_banner = $_POST['id_banner'];
$id_usuario = $_POST['id_banner'];

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

        // Inserindo informações no banco

        $sql1 = $dbh->prepare("UPDATE T_banner SET nome_ban = '$nome_ban',link_ban = '$link_ban',img_ban = '$img_ban',status_ban = '$status_ban',texto_ban = '$texto_ban' WHERE idT_banner = $id_banner");
        $sql1->execute();
        header("Location: http://localhost/criar_banners/view/mostrar_banner.php");
   
    }else{

        $img_ban = $path;

        // Inserindo informações no banco

        $sql1 = $dbh->prepare("UPDATE T_banner SET nome_ban = '$nome_ban',link_ban = '$link_ban',img_ban = '$img_ban',status_ban = '$status_ban',texto_ban = '$texto_ban' WHERE idT_banner = $id_banner");
        $sql1->execute();
        header("Location: http://localhost/criar_banners/view/criar_banner.php");
        header("Location: http://localhost/criar_banners/view/criar_banner.php");
    }

}

//Voltando a página de registro

header("Location: http://localhost/criar_banners/view/mostrarbanner.php");

?>