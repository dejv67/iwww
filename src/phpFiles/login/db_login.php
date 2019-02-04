<?php

    session_start();
    $name = "";
    $surname = "";
    $phone = "";
    $mail = "";
    $errors = array();


    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));

    //registrace
    if(isset($_POST['reg'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $mail = $_POST['mail'];
        $pass = $_POST['password'];
        $pass2 = $_POST['password2'];

        if(empty($name)){
            array_push($errors, "Jméno je nutné vyplnit");
        }
        if(empty($surname)){
            array_push($errors, "Příjmení je nutné vyplnit");
        }
        if(empty($mail)){
            array_push($errors, "E-mail je nutné vyplnit");
        }
        if(empty($pass)){
            array_push($errors, "Heslo je nutné vyplnit");
        }

        if($pass != $pass2){
            array_push($errors, "Hesla nesouhlasí");
        }



        $result = $mysqli->query("SELECT * FROM uzivatel WHERE login='$mail'") or die($mysqli->error);
        if(mysqli_num_rows($result) == 1){
            array_push($errors, "Uživatel s tímto emailem již existuje.");
        }


        if(count($errors) == 0){
            //$password = md5($pass);       //sifrofani hesla


            $mysqli->query("INSERT INTO uzivatel (login, heslo, uz_id_role) VALUES ('$mail', '$pass', 4)") or die($mysqli->error);
            $mysqli->query("INSERT INTO zakaznik(jmeno, prijmeni, telefon, email) VALUES ('$name', '$surname', '$phone', '$mail')")
            or die($mysqli->error);

            $_SESSION['success'] = "Registrace proběhla v pořádku.";

        }

    }

    //login
    if(isset($_POST['log'])){
        $mail = $_POST['mail'];
        $pass = $_POST['password'];


        if(empty($mail)){
            array_push($errors, "E-mail je nutné vyplnit");
        }
        if(empty($pass)){
            array_push($errors, "Heslo je nutné vyplnit");
        }

        if(count($errors) == 0){

            //$password = md5($pass);       //sifrofani hesla

            $result = $mysqli->query("SELECT * FROM uzivatel WHERE login='$mail' AND heslo='$pass'") or die($mysqli->error);

            if(mysqli_num_rows($result) == 1){
                $row = $result->fetch_array();
                $id = $row['login'];
                if ($row['uz_id_role'] == 1){
                    $_SESSION['username'] = "$id";
                    header('location: ../plachta.php');
                }elseif ($row['uz_id_role'] == 2){
                    $_SESSION['username'] = "$id";
                    header('location: ../plachta.php');
                }elseif ($row['uz_id_role'] == 3){
                    $_SESSION['username'] = "$id";
                    header('location: ../vyuka.php');
                }elseif($row['uz_id_role'] == 4){
                    $_SESSION['username'] = "$id";
                    $_SESSION['success'] = "Nyní jste přihlášeni.";
                    header('location: zak_rez.php');
                }
            }else{
                array_push($errors, "Nesprávný e-mail nebo heslo.");

            }


        }

    }


    //logout
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header('location: index.php');
    }


?>