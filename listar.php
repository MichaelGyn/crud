<?php

include_once 'base.php';
include_once 'validateSession.php';

$con = mysqli_connect("localhost", "root", "123456", "Teste");

if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
}
    
$query = "SELECT * FROM users";

$result = mysqli_query($con, $query);

if ($result){
    echo "<table class=table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope=col>ID</th>";
    echo "<th scope=col>Login</th>";
    echo "<th scope=col>Senha</th>";
    echo "<th scope=col>Acões</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    

    while ($row = $result->fetch_assoc()) {
    //    printf ("%s %s %s\n", $row["id"], $row["login"], $row["password"]);
    echo "<tr>";
        echo "<td>";
            echo $row["id"];
        echo "</td>";
        echo "<td>";
            echo $row["login"];
        echo "</td>";
        echo "<td>";
            echo $row["password"];
        echo "</td>";
        echo "<td>";
            echo "<a href='../editar.php?update=" . $row['id'] . "'>EDITAR</a>" . "<br><br><a href='../deletar.php?deletar=" . $row['id'] . "'>DELETAR</a>";
        echo "</td>";
    echo "</tr>";
    }

    $result->close();
}

mysqli_close();
?>
