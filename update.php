<?php


$id = $_GET['id'];

session_start();

if (isset($_SESSION['cdLog'])) {
    $cod1 = $_GET['sessao'];
    $cod2 = $_SESSION['cdLog'];
    if ($cod1 != $cod2) {
        echo "Erro ao logar!";
        exit;
    }
} else {
    echo "Erro ao logar!";
    exit;
}


$_SESSION['sessaotime'] = time();

if (isset($_SESSION['nmUser']) && (time() - $_SESSION['sessaotime'] > 1800)) {
    session_unset();
    session_destroy();
}

try {

    include 'conexao.php';

    $select = $conn->prepare("SELECT * FROM produto WHERE cd_produto='$id'");
    $select->execute();

    if($select->rowCount() == 1) {
        if($produto = $select->fetch()){
?>

<!DOCTYPE html>
<html>
<head>
<style>       
 body {      
background-color: #17a2b8;
font-family: Arial, sans-serif;
margin: 0;
padding: 0;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}
.container {
background-color: #fff;
padding: 20px;
border-radius: 5px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
text-align: center; } 
a { text-decoration: none; color: #0b6085; } 
a:hover { text-decoration: underline;
.area-restrita {
        background-color: #0b6085;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-size: 16px;
        border-radius: 5px;
    } 
}
</style> 
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPDATE PRODUTO</title>
</head>
<body>
<?php echo '<div class="area-restrita">Área restrita: ' . $_SESSION['nmUser'] . '</div>'; ?>
    <h1>Editar registros</h1>
    <form method="post" action="#">
        <label>Código Produto:</label>
        <input type="text" name="cd_produto" value="<?php echo $produto['cd_produto']; ?>" disabled><br>
        <label>Nome Produto:</label>
        <input type="text" name="nm_produto" maxlength="45" value="<?php echo $produto['nm_produto']; ?>">
        <br>
        <label>Valor Produto:</label>
        <input type="number" name="vl_produto"  maxlength="50" value="<?php echo $produto['vl_produto']; ?>">
        <br>
        <label>Link Produto:</label>
        <input type="text" name="img_produto" value="<?php echo $produto['img_produto']; ?>" ​​​​​​​​​>
        <br>
        <input type="submit" value="Atualizar" name="btnatualizar">
    </form>
</body>
</html>

<?php

            }
        }
    }catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    if(!empty($_POST['btnatualizar'])) {
        $nome = $_POST['nm_produto'];
        $vl_produto = $_POST['vl_produto'];
        $img_produto = $_POST['img_produto'];
        try {
            include 'conexao.php';
    
            $sql = "UPDATE PRODUTO SET nm_produto='$nome', vl_produto='$vl_produto', img_produto='$img_produto'
            WHERE cd_produto='$id'";

            $update = $conn->prepare($sql);

            $update->execute();

            echo $update->rowCount();
            header("location:read.php?sessao={$_SESSION['cdLog']}");
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage(); 
        }
    }
    $conn = null;
?>