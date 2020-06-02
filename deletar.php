<?php

include_once 'base.php';
include_once 'validateSession.php';

$id = $_GET['deletar'];

$con = mysqli_connect("localhost", "root", "123456", "Teste");

if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
    
$query = "DELETE FROM users WHERE id = '$id'";

$result = mysqli_query($con, $query);

    
    if($result == 1) {
        echo ("<script language='JavaScript'>window.alert('Usuário deletado com sucesso!'); window.location.href='../listar.php';</script>");
    
    } else {

        echo ("<script language='JavaScript'>window.alert('Não foi possível atualizar os dados. Tente novamente mais tarde.'); window.location.href='../editar.php';</script>");
       
        
        }    
        mysqli_close();
?>