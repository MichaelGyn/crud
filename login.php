<!DOCTYPE html>
<html>
    <head>
        <meta charset="UFT-8">
        <title>Login On System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <script language="javascript" type="text/javascript">
            function validar() {
                var login = formLogin.login.value;
                var pwd = formLogin.pwd.value;
            
            if (login == "") {
                alert('Preencha o campo com seu nome');
                formLogin.login.focus();
                return false;
            }
            if (pwd == "") {
                alert('Preencha o campo com sua senha');
                formLogin.pwd.focus();
                return false;
            }
        }
        </script>
    </head>
<body>

<div id="login">
        <h3 class="text-center text-white pt-5">Login</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" name="formLogin" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="login" class="text-info">Login:</label><br>
                                <input type="text" name="login" id="login" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Senha:</label><br>
                                <input type="password" name="pwd" id="pwd" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lembre-me" class="text-info"><span>Lembre-me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" onclick="return validar()" name="submit" class="btn btn-outline-info" value="Enviar">
                               
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Cadastre-se</a>
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

$login = $_POST['login'];
$pwd = $_POST['pwd'];

if(isset($login) && isset($pwd) && !empty($login) && !empty($pwd)){

if(empty($login) || empty($pwd)) {
    echo ("<script language='JavaScript'>window.alert('Insira os dados Corretamente!'); window.location.href='../login.php';</script>");
}

$loginWithSpace = str_replace(' ', '', $login);
$pwdWithSpace = str_replace(' ', '', $pwd);

if($login !== $loginWithSpace || $pwd !== $pwdWithSpace ) {
    echo ("<script language='JavaScript'>window.alert('Há espaços nos dados! Por favor os remova e tente novamente'); window.location.href='../login.php';</script>");
    
    }


$con = mysqli_connect("localhost", "root", "123456", "Teste");

    if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }

$hash = md5("teste");
$pwd = md5($pwd);
$addToBankData = $hash . $pwd;

$query = "SELECT * FROM users Where login = '$login' AND password = '$addToBankData'";

$result = mysqli_query($con, $query);

$row = mysqli_num_rows($result);
    
    if($row == 1) {
        setcookie("Login", $login, time()+3600);
        setcookie("Password", $pwd, time()+3600);
        echo ("<script language='JavaScript'>window.alert('Login realizado com sucesso! Clique aqui para continuar'); window.location.href='../home.php';</script>");
    
    } else {
        echo ("<script language='JavaScript'>window.alert('Dados não encontrados! Tente Novamente.'); window.location.href='../login.php';</script>");
}
    
mysqli_close($con);

}    
?>