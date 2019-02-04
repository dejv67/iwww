<?php

session_start();

$mysqli = new mysqli('db', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));

$update = false;
$login = '';
$pass= '';
$role = '';


if(isset($_POST['save'])){
    $login = $_POST['login'];
    $pass = $_POST['heslo'];
    $role = $_POST['role'];

    $mysqli->query("INSERT INTO uzivatel (login, heslo, uz_id_role)
                        VALUES ('$login', '$pass', '$role')")
    or die($mysqli->error);

    $_SESSION['message'] = "Záznam byl uložen.";
    header('location: uzivatele.php');

}
if (isset($_GET['delete'])){
    $log = $_GET['delete'];
    $mysqli->query("DELETE FROM uzivatel WHERE login='$log'") or die($mysqli->error);

    $_SESSION['message'] = "Záznam byl smazán.";
}

if (isset($_GET['edit'])){
    $log = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM uzivatel WHERE login='$log'") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $login = $row['login'];
        $pass = $row['heslo'];
        $role = $row['uz_id_role'];
    }

}

if (isset($_POST['update'])){
    $login = $_POST['login'];
    $pass = $_POST['heslo'];
    $role = $_POST['role'];

    $mysqli->query("UPDATE uzivatel SET login='$login', heslo='$pass', uz_id_role='$role' 
WHERE id_zakaznika=$id") or die($mysqli->error);

    $_SESSION['message'] = "Záznam byl upraven.";
    header('location: uzivatele.php');
}


