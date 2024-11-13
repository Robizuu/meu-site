<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sua Página</title>    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id=read>
<?php
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
    // A última solicitação foi há mais de 30 minutos
    session_unset();
    session_destroy();
}

try {
    include 'conexao.php';

    $select = $conn->prepare("SELECT * FROM PRODUTO");
    $select->execute();
?>

<table border='1'>
    <tr>
        <th>Código Produto</th>
        <th>Nome Produto</th>
        <th>Valor Produto</th>
        <th>Caminho Imagem</th>
        <th colspan="2">Gerenciamento</th>
    </tr>
<?php while($produto = $select->fetch()){ ?>
    <tr>
        <td> <?php echo $produto['cd_produto'];  ?> </td>
        <td> <?php echo $produto['nm_produto']; ?> </td>
        <td> <?php echo $produto['vl_produto']; ?> </td>
        <td> <?php echo $produto['img_produto']; ?> </td>
        <td><a href="delete.php?id=<?php echo $produto['cd_produto']?>&sessao=<?php echo $_SESSION['cdLog']; ?>">Excluir</a></td>
        <td><a href="update.php?id=<?php echo $produto['cd_produto']?>&sessao=<?php echo $_SESSION['cdLog']; ?>">Editar</a></td>

    </tr> 
<?php } ?>
</table>
<a href="interface.php?sessao=<?php echo $_SESSION['cdLog'];?>">Interface</a>
<?php
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage(); 
}

$conn = null;
?>
</body>
</html>