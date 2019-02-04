<?php include('db_login.php');

/* if(empty($_SESSION['username'])){
     header('location: login.php');
 }*/

?>
<?php
//odeslani formulare
$mysqli = new mysqli('db', 'user', 'password', 'db_dev') or  die($mysqli_error($mysqli));
$uz_mail;
$uz_name;
$uz_id;
if(isset($_SESSION["username"])) {
    $uz_mail = $_SESSION['username'];

    $res = $mysqli->query("SELECT * from zakaznik where email='$uz_mail'") or die($mysqli->error);
    if (count($res) == 1){
        $row = $res->fetch_assoc();
        $uz_name = $row['jmeno'] .' '. $row['prijmeni'];
        $uz_id= $row['id_zakaznika'];
    }
}




if(isset($_POST['rezer'])) {
    $from = $_POST['date1'];
    $to = $_POST['date2'];
    $tools = $_POST['tools'];
    $lesson = $_POST['lesson'];
    $pocDeti = $_POST['countKids'];
    $jmenaDeti = $_POST['namesKids'];
    $note = $_POST['note'];

    $pocHodin = 0;
    $dateFrom = new DateTime($from);
    $dateTo = new DateTime($to);


    $difference = $dateFrom->diff($dateTo);
    $pocDnu = $difference->days + 1;

    if ($lesson == "priv1") {
        $pocHodin = 2;
        $note = "$note /Privát|2h";
    } elseif ($lesson == "priv2") {
        $pocHodin = 4;
        $note = "$note /Privát|4h";
    } else {
        $pocHodin = 4;
        $note = "$note /Rodinná výuka";
    }

    if ($pocDnu != 0) {
        $pocHodin = $pocHodin * $pocDnu;
    }


    $mysqli->query("INSERT INTO rez_vyuky (dat_od, dat_do, poc_hod, email_zak, poc_deti, stav, jmena_deti, pozn, nastroj, jmenoZak, rez_zak_id)
                            VALUES ('$from', '$to', '$pocHodin', '$uz_mail', '$pocDeti', 0, '$jmenaDeti', '$note', '$tools', '$uz_name', '$uz_id')")
    or die($mysqli->error);

    $_SESSION['message'] = "Rezervace byla odeslána. O jejím stavu vás budeme informovat e-mailem.";
}
?>

<!doctype html>
<html  lang="cz">

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/login.css">
    <link rel="stylesheet" type="text/css" href="../../css/responsive.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aron | Lyžařská škola </title>
</head>
<body>

<--<header>
    <nav id="nav">
        <a href="#">Nová rezervace</a>
        <a href="zak_prof.php">Profil</a>
        <a href="zak_rez.php">Seznam Rezervací</a>
        <a href="../../index.php?logout='1'">Odhlásit</a>
    </nav>
</header>




<section >
    <div id="login">
        <H2>Nová rezervace</H2>
    </div>

    <form method="post" action="zak_form.php">
        <?php include('log_errors.php');

            $date1='';
            $date2='';
            $tools='';
            $lesson='';
            $countKids='';
            $namesKids='';
            $note='';

        ?>

        <div class="input-group">


        <div class="input-group">
            <label>Od</label>
            <input type="date" name="date1" value="<?php echo $date1?>"/>
        </div>
        <div class="input-group">
            <label>Do</label>
            <input type="date" name="date2" value="<?php echo $date2?>"/>
        </div>
        <div class="input-group">
            <select name="tools" value="<?php echo $tools?>">
                <option value="ski">lyže</option>
                <option value="snb">snowboard</option>
            </select>
        </div>
        <div class="input-group">
            <select name="lesson" value="<?php echo $lesson?>">
                <option value="priv1">Privátní výuka | 2h</option>
                <option value="priv2">Privátní výuka | 4h</option>
                <option value="rod">Rodinná výuka</option>
            </select>
        </div>
        <div class="input-group">
            <label>Počet dětí:</label>
            <input type="number" name="countKids" min="0" max="5" value="<?php echo $countKids?>"/>
        </div>
        <div class="input-group">
            <label>Jména dětí</label>
            <input type="text" name="namesKids" value="<?php echo $namesKids?>"/>
        </div>
        <div class="input-group">
            <label>Poznámka</label>
            <textarea rows="4" cols="50" name="note" value="<?php echo $note?>"></textarea>
        </div>
        <div class="input-group">
            <button type="submit" name="rezer" class="btn">Odeslat</button>
        </div>
        <div>
            <?php if(isset($_SESSION['message'])): ?>
                <div class="error success">
                    <h3>
                        <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </h3>


                </div>
            <?php endif ?>
        </div>
    </form>

</section>











</body>
</html>
