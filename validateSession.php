<?php

$validate = $_COOKIE["Password"];

$hash = md5("teste");

$verificate = $hash . $validate;

$con = mysqli_connect("localhost", "root", "123456", "Teste");

    if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          exit();
        }
 
$query = "SELECT * FROM users Where password = '$verificate'";

$result = mysqli_query($con, $query);

$row = mysqli_num_rows($result);
    
    if($row == 0) {
        echo ("<script language='JavaScript'>window.alert('Sessão encerradas! Tente Novamente.'); window.location.href='../login.php';</script>");
        
    
    } else {
        //echo "Sessao ativa";
}
    
mysqli_close($con);

    