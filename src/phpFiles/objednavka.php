<?php

    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));

if(isset($_POST['send'])) {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $from = $_POST['date_from'];
    $to = $_POST['date_to'];
    $tools = $_POST['tools'];
    $lesson = $_POST['lesson'];
    $pocDeti= $_POST['countKids'];
    $jmenaDeti= $_POST['namesKids'];
    $note = $_POST['note'];

    $pocHodin = 0;
    $dateFrom = new DateTime($from);
    $dateTo = new DateTime($to);
//echo $from;
//echo $to;
    $difference = $dateFrom->diff($dateTo);
    $pocDnu = $difference->days + 1;

    if($lesson == "priv1"){
        $pocHodin = 2;
        $note = "$note /Privát|2h";
    }elseif ($lesson == "priv2"){
        $pocHodin = 4;
        $note = "$note /Privát|4h";
    }else{
        $pocHodin = 4;
        $note = "$note /Rodinná výuka";
    }

    if($pocDnu != 0){
        $pocHodin = $pocHodin * $pocDnu;
    }

    $mysqli->query("INSERT INTO rez_vyuky (dat_od, dat_do, poc_hod, email_zak, poc_deti, stav, jmena_deti, pozn, nastroj, jmenoZak)
                        VALUES ('$from', '$to', '$pocHodin', '$mail', '$pocDeti', 0, '$jmenaDeti', '$note', '$tools', '$name')")
    or die($mysqli->error);

    $_SESSION['message'] = "Rezervace byla odeslána. O jejím stavu vás budeme informovat e-mailem.";
    header('location: ../index.php#rezervace');
}