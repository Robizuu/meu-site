<?php

include 'conexao.php';

 if (isset($_COOKIE['usuario'])) {
    $nome_cookie = $_COOKIE['usuario'];
} else {
    $nome_cookie = "";
}

if (!empty($_POST['submit']) && !empty($_POST['username'])) {

     if (!empty($_POST['remember-me'])) {
        
        $usercookie = $_POST['username'];
        setcookie('usuario', $usercookie, time() + 3600); 
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

</head>


<body id="login">
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" value="<?php echo $nome_cookie ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="register.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
if(!empty($_POST['submit'])) {

    $nome = $_POST['username'];
    $senha = $_POST['password'];


    try {
        include 'conexao.php';

        $select = $conn->prepare("SELECT nm_admin FROM admin WHERE cd_senha='$senha' AND nm_admin='$nome'");
        $select->execute();
        
        
       
        if ($select->rowCount()==1){
 
            $user = $_POST['username'];

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            if (!isset($_SESSION['cdLog'])) {
                $numAleatorio = rand(5000000, 100000000);
                $_SESSION['cdLog'] = $numAleatorio;
                $_SESSION['nmUser'] = $user;
                session_start();
            }

            
            header("Location: interface.php?sessao={$_SESSION['cdLog']}");

            
            
        }

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage(); 
    }
    $conn = null;
}


?>
