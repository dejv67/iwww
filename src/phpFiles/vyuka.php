<?php include('login/db_login.php');

/*if(empty($_SESSION['username'])){
    header('location: login/login.php');
}*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>Výuka</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="lista">
    <nav id="nav">
        <a href="insProfil.php">Profil</a>
        <a href="#">Výuka</a>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>

<section style="margin-top: 80px; margin-left: 20px; margin-right: 20px;">
    <div>
        <h2>Výuka</h2>
        <?php $date = date('Y-m-d'); ?>
        <br>
        <form action="" method="POST">
            <h4>Vyber datum</h4>
            <input type="date" value=<?php echo $date?> name="datum"/>
            <button type="submit" name="submit" class="btn">Zobrazit</button>
        </form>
        <br>

        <?php
        if(isset($_POST['submit'])) {
            $date = $_POST['datum'];
            $uz_mail;
        if(isset($_SESSION["username"])) {
            $uz_mail = $_SESSION['username'];
        }


            $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
            $res = $mysqli->query("SELECT * FROM instruktor WHERE email='$uz_mail'") or die($mysqli->error);
            $rw=$res->fetch_assoc();
            $uz_id = $rw[id_instruktora];

            $result = $mysqli->query("SELECT * FROM konkretni_vyuka WHERE datum='$date' and konk_inst_id='$uz_id' ORDER BY od_h ASC ") or die($mysqli->error);


        ?>
        <p>Zobrazena výuka pro <?php echo $date?>.</p>
        <table>
            <thead>
            <th></th>
            <th></th>
            </thead>
            <tbody>
            <?php
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <div class="row" style="background-color:#7AD3FF; border-bottom: 2px solid #000000;
                border-radius: 10px 10px 10px 10px; padding-bottom: 5px; padding-top: 5px; padding-left: 5px;margin-bottom: 5px;">
                    <h3><?php echo $row[od_h] .' | '. $row[do_h]; ?></h3>
                    <p><?php echo $row[misto_setkani]; ?></p>
                    <p><?php echo 'Počet dětí: '.$row[poc_deti]; ?></p>
                    <p><?php echo $row[pozn]; ?></p>
                </div>

            </tr>
            </tbody>
            <?php endwhile; }?>
        </table>


        </div>
</section>


</body>
