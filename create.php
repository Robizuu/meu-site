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
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
<?php echo '<div class="area-restrita">Área restrita: ' . $_SESSION['nmUser'] . '</div>'; ?>
    <form method="post" action="#">
        <input type="text" name="nome_produto" placeholder="Nome do Produto" required><br>
        <input type="number" name="preco_produto" placeholder="Preço" required><br>
        <input type="text" name="link_img" placeholder="Link Imagem" required><br>
        <input type="submit" name="create" value="Adicionar Produto">
    </form>
<br><br>
  

<a href="interface.php?sessao=<?php echo $_SESSION['cdLog'];?>">interface</a>
</div>
</body>

</html>

<?php
if(!empty($_POST['create'])){
    $nome_produto = $_POST['nome_produto'];
    $preco_produto = $_POST['preco_produto'];
    $link_img = $_POST['link_img'];
    
    try{

        include 'conexao.php';
        
        $sql="INSERT INTO PRODUTO(nm_produto,vl_produto,img_produto) VALUES (
            '$nome_produto','$preco_produto','$link_img')";

            $conn->exec($sql);
        echo "Produto inserido com sucesso!";

    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage(); 
    }
    $conn = null;

}

    
?>