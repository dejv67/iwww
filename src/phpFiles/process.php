<?php

    $mysqli = new mysqli('localhost', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));

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

        $mysqli->query("INSERT INTO instruktor (jmeno, prijmeni, telefon, email, ucet, nastroje, jazyky, plat, poznamka)
                        VALUES ('$name', '$surname', '$tel', '$mail', '$account', '$tools', '$languages' '$salary', '$note')") or die($mysqli->error);

}