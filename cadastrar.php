<?php

include_once 'base.php';
include_once 'validateSession.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
             <h1>Cadastrar Usuário:</h1>
        </div>
    </div>
    <div class="col-sm-6">
        <form action="" method="POST" name="form">
            <div class="form-group">
                <label for="name">Login: </label>
                <input type="text" class="form-control" name="login" placeholder="Insira seu nome (Sem espaços)" autofocus>
            </div>
            <div class="form-group">
                <label for="pwd">Senha: </label>
                <input type="password" class="form-control" name="pwd" placeholder="Insira sua senha (Sem espaços)">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-outline-info" value="Enviar">
                <a href="../home.php" class="btn btn-outline-info">Voltar</a>
            </div>
        </form>
    </div>
</div>

</body>

</html>
<?php

$login = $_POST['login'];
$pwd = $_POST['pwd'];

if(isset($login) && isset($pwd) && !empty($login) && !empty($pwd)){

if(empty($login) || empty($pwd)) {
    echo ("<script language='JavaScript'>window.alert('Insira os dados Corretamente!'); window.location.href='../cadastrar.php';</script>");
    exit();
}

$loginWithSpace = str_replace(' ', '', $login);
$pwdWithSpace = str_replace(' ', '', $pwd);

if($login !== $loginWithSpace || $pwd !== $pwdWithSpace ) {
    echo ("<script language='JavaScript'>window.alert('Há espaços nos dados! Por favor os remova e tente novamente'); window.location.href='../cadastrar.php';</script>");
    exit();
}


$con = mysqli_connect("localhost", "root", "123456", "Teste");

if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    
$query1 = "SELECT login FROM users Where login = '$login'";

$result = mysqli_query($con, $query1);

$row = mysqli_num_rows($result);
    
    if($row >= 1) {
        echo ("<script language='JavaScript'>window.alert('Já existe um login cadastrado! Selecione outro login e tente novamente'); window.location.href='../cadastrar.php';</script>");
    
    } else {
        $pwd = md5($pwd);
        $descrypt = md5("teste");
        $secret = $descrypt . $pwd;

        $query = "INSERT INTO users (id, login, password) VALUES(NULL, '$login', '$secret')";
            
        if (mysqli_query($con, $query)) {
            exit("<script language='JavaScript'>window.alert('Novo cadastro realizado com Sucesso!'); window.location.href='../cadastrar.php';</script>");
        } else {
            echo "Error: " . $query . "" . mysqli_error($con);
        }
        mysqli_close();
        }    
    }
?>