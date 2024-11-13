<?php

 
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $exists = $conn->prepare("CREATE DATABASE IF NOT EXISTS banco");
    $exists->execute();

    $conn = new PDO("mysql:host=$servername;dbname=banco", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if($exists) {
        $createTableAdmin = $conn->prepare("CREATE TABLE IF NOT EXISTS ADMIN  (
            cd_admin integer primary key auto_increment,
            nm_admin varchar(50) NOT NULL,
            cd_senha varchar(255) NOT NULL)");
        
        
        $createTableProduto = $conn->prepare("CREATE TABLE IF NOT EXISTS PRODUTO  (
            cd_produto integer primary key auto_increment,
            nm_produto varchar(100) NOT NULL,
            vl_produto DECIMAL(10,2) NOT NULL,
            img_produto varchar(200));");

        $createRegisterAdmin1 = $conn->prepare("INSERT IGNORE INTO ADMIN (cd_admin, nm_admin, cd_senha) VALUES (38, 'administrador', '1234')");
        $createRegisterAdmin2 = $conn->prepare("INSERT IGNORE INTO ADMIN (cd_admin, nm_admin, cd_senha) VALUES (69, 'admin', 'senha')");

        $createRegisterProduto1 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (40, 'chave de fenda', 30.50, 'projetoCRUD/chave_fenda.jpg')");
        
        $createRegisterProduto2 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (41, 'chave inglesa', 25.00, 'projetoCRUD/chave_inglesa.jpg')");
        
        $createRegisterProduto3 = $conn->prepare("INSERT IGNORE INTO PRODUTO (cd_produto, nm_produto, vl_produto, img_produto) VALUES (42, 'chave americana', 10.50, 'projetoCRUD/chave_americana.jpg')");



        


            $createTableAdmin->execute();
            $createTableProduto->execute();
            $createRegisterAdmin1->execute();
            $createRegisterAdmin2->execute();
            $createRegisterProduto1->execute();
            $createRegisterProduto2->execute();
            $createRegisterProduto3->execute();
        }
} catch(PDOException $e) {
    echo "Connection failed: " . $e ->getMessage();
}
?>