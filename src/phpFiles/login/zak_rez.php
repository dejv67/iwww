<?php include('db_login.php');

   /* if(empty($_SESSION['username'])){
        header('location: login.php');
    }*/

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
        <a href="zak_form.php">Nová rezervace</a>
        <a href="zak_prof.php">Profil</a>
        <a href="#">Seznam Rezervací</a>
        <a href="../../index.php?logout='1'">Odhlásit</a>
    </nav>
</header>



    <div id="login">
        <H2>Seznam rezervací</H2>
    </div>

    <div class="content">
        <?php
        if(isset($_SESSION["username"])) {
            $uz_mail = $_SESSION['username'];
        }


        $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
        $res = $mysqli->query("SELECT * FROM zakaznik WHERE email='$uz_mail'") or die($mysqli->error);
        $rw=$res->fetch_assoc();
        $uz_id = $rw[id_zakaznika];

        $result = $mysqli->query("SELECT * FROM rez_vyuky WHERE rez_zak_id='$uz_id' ORDER BY dat_od ASC ") or die($mysqli->error);


        ?>
        <table>
            <thead>
            <th></th>
            </thead>
            <tbody>
            <?php
            while($row = $result->fetch_assoc()): ?>
            <tr style="border-bottom: 1px solid #ddd;">
                <div class="row" style="background-color:#7AD3FF; border-bottom: 2px solid #000000;
             border-radius: 10px 10px 10px 10px; padding-bottom: 5px; padding-top: 5px; padding-left: 5px;margin-bottom: 5px;">
                    <h3><?php echo $row[dat_od] .'  |  '. $row[dat_do]; ?></h3>
                    <p><?php echo 'Počet hodin: '.$row[poc_hod]; ?></p>
                    <p><?php echo 'Počet dětí: '.$row[poc_deti]; ?></p>
                    <p><?php echo $row[jmena_deti]; ?></p>
                    <p><?php echo $row[nastroj]; ?></p>
                    <p><?php echo $row[pozn]; ?></p>
                    <?php if($row[stav] == 0){ ?>
                          <p style="color: red"><?php echo 'Nepotvrzeno'; ?></p>
                        <?php }elseif ($row[stav] == 1){?>
                          <p style="color: green"><?php echo 'Potvrzeno'; ?></p>
                        <?php } ?>
                </div>
            </tr>
            </tbody>
            <?php endwhile; ?>
        </table>
    </div>




</body>
</html>
