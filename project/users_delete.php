<?php

include 'db.php';


    $id = $_GET["id"];
    //$name = $_GET["name"];
    $sql = "DELETE FROM users WHERE id='$id'";
    $res = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " ). mysqli_error();

    if($res == TRUE){
        header("Location: tables.php");
    }

?>
