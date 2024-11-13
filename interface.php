
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

if(isset($_SESSION['nmUser']) && (time() - $_SESSION['sessaotime'] > 1800)) {
 
    session_unset();     
    session_destroy();   
}




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
   <title>Gerenciamento de Produtos</title>
</head>
<body>
    <div class="container">
        <?php ?>
        <h2>Gerenciamento de Produtos</h2>
        <h3>Bem-vindo!</h3>
        
        <a href="create.php?sessao=<?php echo $_SESSION['cdLog'];?>"> Cadastrar produtos</a><br>
        <a href="read.php?sessao=<?php echo $_SESSION['cdLog'];?>"> Gerenciar produtos</a><br>
        <br>

        <a href="sair.php">Sair</a>
    </div>
</body>
</html>

