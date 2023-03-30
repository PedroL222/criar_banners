<?php
session_start();
ob_start();

if(!isset($_SESSION['id']) && !isset($_SESSION['nome'] )){
    header('Location: ../index.php');
    $_SESSION['msg'] = '<p>Erro: Você tem que está logado para acessar o site</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link id="pagestyle" href="../assets/css/corporate-ui-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="../css_normal/mostrar_banner.css">
</head>
<body>

    <?php

        include_once("../config.php");
        $id = $_SESSION['id'];

        $sql2 = "SELECT * FROM T_banner WHERE T_usuario_idT_usuario = $id";
        $exec2 = $dbh->prepare($sql2);
        $res2 = $exec2->execute();
        $itens = $exec2->fetchAll();

        foreach($itens as $linhas){

    ?>

    <div id="banner">
    <h1 id="banner-text"><?php echo $linhas['texto_ban'] ?></h1>
    <a id="banner-link" href="<?php echo $linhas['link_ban'] ?>">
    </a>
    <img id="banner-image" src="<?php echo $linhas['img_ban'] ?>" alt="Imagem do Banner" />
    </div>

    <form method="post" action="./editar_banner.php">
        <input name="id_banner" id="bnt_editar" value="<?php echo $linhas['idT_banner']; ?>" style="display: none;">
        <div style="width: 100%; display:flex; justify-content: center; margin-top:20px;"><button type="submit" class="btn btn-primary">Editar</button></div>
    </form>

    <?php } ?>

    <div style="width: 100%; display:flex; justify-content: center; margin-top:20px;"><a href="http://localhost/criar_banners/view/criar_banner.php" type="submit" class="btn btn-primary">Voltar</a></div>
    
</body>
</html>