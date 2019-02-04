<?php

session_start();

$mysqli = new mysqli('db', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$surname = '';
$tel = '';
$mail = '';


if(isset($_POST['save'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

    $result = $mysqli->query("SELECT * FROM uzivatel WHERE login='$mail'") or die($mysqli->error);

    if (mysqli_num_rows($result) == 0){
        $mysqli->query("INSERT INTO uzivatel (login, heslo, uz_id_role)
                        VALUES ('$mail', 'heslo', 4)")
        or die($mysqli->error);

        $mysqli->query("INSERT INTO zakaznik (jmeno, prijmeni, telefon, email)
                        VALUES ('$name', '$surname', '$tel', '$mail')")
    or die($mysqli->error);

        $_SESSION['message'] = "Záznam byl uložen.";
        header('location: zakaznici.php');

    }else {
        $_SESSION['message'] = "Uživatel s tímto e-mailem již existuje.";
        header('location: zakaznici.php');
    }

}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM zakaznik WHERE id_zakaznika=$id") or die($mysqli->error);

    if (isset($_SESSION['del'])) {
        $iden = $_SESSION['del'];
        $mysqli->query("DELETE FROM uzivatel WHERE login='$iden'") or die($mysqli->error);
        unset($_SESSION['del']);
        $_SESSION['message'] = "Záznam byl smazán.";
    }
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM zakaznik WHERE id_zakaznika=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['jmeno'];
        $surname = $row['prijmeni'];
        $tel = $row['telefon'];
        $mail = $row['email'];
    }

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];

    $mysqli->query("UPDATE instruktor SET jmeno='$name', prijmeni='$surname', telefon='$tel', email='$mail'
 WHERE id_zakaznika=$id")
    or die($mysqli->error);

    $_SESSION['message'] = "Záznam byl upraven.";
    header('location: zakaznici.php');

}


