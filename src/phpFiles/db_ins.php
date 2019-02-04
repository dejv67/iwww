<?php

    session_start();

    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));

    $id = 0;
    $update = false;
    $name = '';
    $surname = '';
    $tel = '';
    $mail = '';
    $account = '';
    $tools = '';
    $languages = '';
    $salary = 0;
    $note = '';
    $pass= '';


if(isset($_POST['save'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $account = $_POST['account'];
    $tools = $_POST['tools'];
    $languages = $_POST['languages'];
    $salary = $_POST['salary'];
    $note = $_POST['note'];
    $pass = $_POST['pass'];

    //zjisti jestli uz takovy uzivatele neni a pokud ne tak nejdriv zadej uzivatele a potom instruktora
    $result = $mysqli->query("SELECT * FROM uzivatel WHERE login='$mail'") or die($mysqli->error);

    if (mysqli_num_rows($result) == 0){
        $mysqli->query("INSERT INTO uzivatel (login, heslo, uz_id_role)
                        VALUES ('$mail', '$pass', 3)")
        or die($mysqli->error);

        $mysqli->query("INSERT INTO instruktor (jmeno, prijmeni, telefon, email, ucet, nastroje, jazyky, plat, poznamka)
                        VALUES ('$name', '$surname', '$tel', '$mail', '$account', '$tools', '$languages', '$salary', '$note')")
        or die($mysqli->error);

        $_SESSION['message'] = "Záznam byl uložen.";
        header('location: instruktori.php');

    }else {
        $_SESSION['message'] = "Uživatel s tímto e-mailem již existuje.";
        header('location: instruktori.php');
    }
}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM instruktor WHERE id_instruktora=$id") or die($mysqli->error);

    if (isset($_SESSION['del'])) {
        $iden = $_SESSION['del'];
        $mysqli->query("DELETE FROM uzivatel WHERE login='$iden'") or die($mysqli->error);
        unset($_SESSION['del']);
        //$_SESSION['message'] = "Záznam byl smazán.";
        $_SESSION['message'] = $iden;
    }

}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM instruktor WHERE id_instruktora=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['jmeno'];
        $surname = $row['prijmeni'];
        $tel = $row['telefon'];
        $mail = $row['email'];
        $account = $row['ucet'];
        $tools = $row['nastroje'];
        $languages = $row['jazyky'];
        $salary = $row['plat'];
        $note = $row['poznamka'];
    }

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $account = $_POST['account'];
    $tools = $_POST['tools'];
    $languages = $_POST['languages'];
    $salary = $_POST['salary'];
    $note = $_POST['note'];

    $mysqli->query("UPDATE instruktor SET jmeno='$name', prijmeni='$surname', telefon='$tel', email='$mail',
 ucet='$account', nastroje='$tools', jazyky='$languages', plat='$salary', poznamka='$note' WHERE id_instruktora=$id")
    or die($mysqli->error);

    $_SESSION['message'] = "Záznam byl upraven.";
    header('location: instruktori.php');
}


