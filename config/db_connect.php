
<?php


function db(){
    $db_host='localhost';
    $db_user='root';
    $db_password='';
    $database='tododb';
    global $dbc;
    $dbc = mysqli_connect($db_host,$db_user,$db_password,$database) or  die("couldn’t connect to database");
    return $dbc;
}
?>
