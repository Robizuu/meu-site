<?php

session_start();

if(isset($_SESSION["nmUser"])){
    include 'conexao.php';

    $id = $_GET['id'];

    try {
        include 'conexao.php';

        $sql = "DELETE FROM produto WHERE cd_produto='$id'";

        $conn->exec($sql);
        
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;

    header("location:read.php?sessao={$_SESSION['cdLog']}");
    
    

} else {
    header('location:index.php');
}

?>