<?php include('login/db_login.php');

/*if(empty($_SESSION['username'])){
    header('location: login/login.php');
}*/
$uz_id;
if(isset($_SESSION["username"])){
    $uz_id = $_SESSION['username'];
}
?>
<?php

if(isset($_POST['create'])){

    $idRz = $_POST['id'];
    $pocDet = $_POST['pocDet'];
    $idIns = $_POST['instruktor'];
    $datum = $_POST['datum'];
    $time1 = $_POST['cas1'];
    $time = new DateTime($time1);
    $time = $time->modify('+1 hours');
    $time2 = $time->format('H:i');
    $place = $_POST['misto'];
    $note = $_POST['note'];


    //overeni dostupnosti
    $vys = $mysqli->query("SELECT * FROM konkretni_vyuka WHERE datum = '$datum' AND konk_inst_id = '$idIns' AND od_h = '$time1'") or die($mysqli->error);
    if(count($vys)==1){
        $_SESSION['warning'] = "Instruktor má v tuto dobu již výuku.";
    }else{
        $result = $mysqli->query("INSERT INTO konkretni_vyuka (misto_setkani, od_h, do_h, poc_deti,
pozn, konk_inst_id, konk_rez_id, datum) VALUES('$place', '$time1', '$time2', '$pocDet', '$note',
  '$idIns', '$idRz', '$datum')") or die($mysqli->error);
        $_SESSION['message'] = "Výuka zadána.";
    }

}

if (isset($_GET['potvrdit'])) {
    $id = $_GET['potvrdit'];
    $mysqli->query("UPDATE rez_vyuky SET stav=1 WHERE id_rez='$id'") or die($mysqli->error);
    $_SESSION['message'] = "Rezervace potvrzena.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seznam rezervací</title>
    <link rel="stylesheet" href="../css/print2.css" type="text/css" media="print" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="lista">
    <nav id="nav">
        <a href="plachta.php">Plachta</a>
        <a href= "#">Rezervace</a>
        <a href="instruktori.php">Instruktoři</a>
        <a href="zakaznici.php">Zákaznici</a>
        <?php if($uz_id=="admin"){
            ?><a href="uzivatele.php">Uživatelé</a><?php
        }?>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>

<section style="margin: 20px 20px">

<h2 style="margin-top: 80px;">Rezervace</h2>
    <a  class="point" href="../export.php">XML export</a>
    <?php if(isset($_SESSION['warning'])): ?>
        <div class="error">
            <h3>
                <?php
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
                ?>
            </h3>


        </div>
    <?php endif ?>
    <?php if(isset($_SESSION['message'])): ?>
        <div class="success">
            <h3>
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </h3>


        </div>
    <?php endif ?>
    <br>

<?php
        $result = $mysqli->query("SELECT * FROM rez_vyuky ORDER BY dat_od ASC ") or die($mysqli->error);


    ?>
    <table>
        <thead>
        <th></th>
        <th></th>
        </thead>
        <tbody>
        <?php
        $idRez;
        $jmenoZak;
        $pocHod;
        $pocDeti;
        $jmDeti;
        $tools;
        $note;
        while($row = $result->fetch_assoc()): ?>
        <tr>
            <div class="row" style="background-color:#7AD3FF; border-bottom: 2px solid #000000;
                 border-radius: 10px 10px 10px 10px; padding-bottom: 5px; padding-top: 5px; padding-left: 5px;margin-bottom: 5px;
                 display: flex; flex-wrap: wrap; justify-content: space-between;">
                <section>
                    <?php
                    ?>
                    <h3><?php echo $row[dat_od] .' | '. $row[dat_do]; ?></h3>
                    <h4><?php echo $row['jmenoZak']; ?></h4>
                    <p><?php echo $row[email_zak]; ?></p>
                    <p><?php echo 'Počet hodin: '.$row['poc_hod']; ?></p>
                    <p><?php echo 'Počet dětí: '.$row['poc_deti']; ?></p>
                    <p><?php echo $row['jmena_deti']; ?></p>
                    <p><?php echo $row['nastroj']; ?></p>
                    <p><?php echo $row['pozn']; ?></p>
                    <?php if($row[stav] == 0){ ?>
                        <p style="color: red"><?php echo 'Nepotvrzeno'; ?></p>
                    <?php }elseif ($row[stav] == 1){?>
                        <p style="color: green"><?php echo 'Potvrzeno'; ?></p>
                    <?php } ?>
                </section>

                <section class="form" style="margin-top: 10px;">
                    <form  action="rezervace.php" method="POST">
                        <select name="instruktor">
                            <?php
                            $res = $mysqli->query("SELECT * FROM instruktor") or die($mysqli->error);
                            while($rad =$res->fetch_assoc()){?>
                                <option value="<?php echo $rad['id_instruktora']?>"><?php echo $rad['jmeno'].' '.$rad['prijmeni']?></option>
                            <?php }
                            ?>
                        </select>
                        <input type="hidden" name="id" value="<?php echo $row['id_rez']; ?>">
                        <input type="hidden" name="pocDet" value="<?php echo $pocDeti=$row['poc_deti']; ?>">
                        <input type="date" name="datum">
                        <input type="time" name="cas1" value="08:00">
                        <input type="text" name="misto" placeholder="Meeting-point">
                        <input type="text" name="note" placeholder="poznamka">
                        <button type="submit" name="create" class="btn">Vytvořit výuku</button>
                    </form>
                </section>

                <section style="margin-right: 10px; margin-top: 10px;">
                    <a href="rezervace.php?potvrdit=<?php echo $row['id_rez'];?>"
                       class="btnZ">Potvrdit</a>

                </section>
            </div>

        </tr>
        </tbody>
        <?php endwhile;?>

</table>
</section>

</body>
</html>
