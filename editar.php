<?php

include_once 'base.php';
include_once 'validateSession.php';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
             <h1>Editar Usuário:</h1>
        </div>
    </div>
    <div class="col-sm-6">
        <form action="" method="POST" name="form">
            <div class="form-group">
                <label for="name">Novo Login: </label>
                <input type="text" class="form-control" name="login" placeholder="Insira o novo nome (Sem espaços)" autofocus>
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
$id = $_GET['update'];

if(isset($login) && isset($pwd) && !empty($login) && !empty($pwd)){

if(empty($login) || empty($pwd)) {
    echo ("<script language='JavaScript'>window.alert('Insira os dados Corretamente!'); window.location.href='../listar.php';</script>");
    exit();
}

$loginWithSpace = str_replace(' ', '', $login);
$pwdWithSpace = str_replace(' ', '', $pwd);

if($login !== $loginWithSpace || $pwd !== $pwdWithSpace ) {
    echo ("<script language='JavaScript'>window.alert('Há espaços nos dados! Por favor os remova e tente novamente'); window.location.href='../listar.php';</script>");
    exit();
}


$con = mysqli_connect("localhost", "root", "123456", "Teste");

if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

$pwd = md5($pwd);
$encrypt = md5("teste");
$pwd = $encrypt . $pwd;
    
$query1 = "UPDATE users SET login = '$login', password = '$pwd' WHERE id = '$id'";

$result = mysqli_query($con, $query1);
    
    if($result == 1) {
        echo ("<script language='JavaScript'>window.alert('Dados atualizados com sucesso!'); window.location.href='../listar.php';</script>");
    
    } else {

        echo ("<script language='JavaScript'>window.alert('Não foi possível atualizar os dados. Tente novamente mais tarde.'); window.location.href='../editar.php';</script>");
       
        mysqli_close();
        }    
    }
?>