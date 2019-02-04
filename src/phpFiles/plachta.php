<?php include('login/db_login.php');

/*if(empty($_SESSION['username'])){
    header('location: login/login.php');
}*/
$uz_id;
if(isset($_SESSION["username"])){
    $uz_id = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html  lang="cz">
<head>
    <title>Plachta</title>
    <link rel="stylesheet" href="../css/print.css" type="text/css" media="print" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header class="lista">
    <nav id="nav">
        <a href="#">Plachta</a>
        <a href= "rezervace.php">Rezervace</a>
        <a href="instruktori.php">Instruktoři</a>
        <a href="zakaznici.php">Zákaznici</a>
        <?php if($uz_id=="admin"){
            ?><a href="uzivatele.php">Uživatelé</a><?php
        }?>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>

<section style="margin: 20px 20px">
    <h2 style="margin-top: 80px;">Plachta</h2>

    <?php $date = date('Y-m-d'); ?>
    <br>
    <form action="plachta.php" method="POST">
        <h4 class="h4">Vyber datum</h4>
        <input class="input" type="date" value=<?php echo $date?> name="datum"/>
        <button type="submit" name="submit" class="btn">Zobrazit</button>
    </form>
    <br>

    <div class="container">
        <?php
        if(isset($_POST['submit'])) {
        $date = $_POST['datum'];

        $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT jmeno, prijmeni, id_instruktora FROM instruktor") or die($mysqli->error);
        //pre_r($result);           // nechat zakomentovany- k nicemu
        ?>

        <p>Zobrazena plachta pro <?php echo $date?>.</p>
        <div class="row justify-content-between">
            <table class="table" style="margin-top: 10px;">
                <thead>
                <tr style="border: 1px solid black">
                    <th style="border-bottom: 2px solid black;">Instruktor</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">8-9</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">9-10</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">10-11</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">11-12</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">12-13</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">13-14</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">14-15</th>
                    <th style="width: 130px; border-bottom: 2px solid black;">15-16</th>
                </tr>
                </thead>
                <?php
                while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td style="border-right: 2px solid black; border-bottom: 2px solid black;"><?php echo $row[jmeno] .' '. $row[prijmeni]; ?></td>
                        <?php
                            $res = $mysqli->query("SELECT * FROM konkretni_vyuka WHERE konk_inst_id ='$row[id_instruktora]'
                                                AND datum='$date' ORDER BY od_h ASC") or die($mysqli->error);
                            $poc = 8;
                            $help = 0;
                            while($vyuka = $res->fetch_assoc()):
                                $hodina = substr($vyuka[od_h], 0,2);
                                $hodina2 = substr($vyuka[do_h], 0,2);
                                switch ($hodina){
                                    case 8:?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 8;
                                        break;
                                    case 9:
                                        if($help == 1){?>
                                            <td>
                                                <div class="aktivita">
                                                    <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                    <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                    <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                    <p><?php echo $vyuka[pozn]; ?></p>
                                                </div>
                                            </td>
                                            <?php
                                            $poc = 9;
                                        }else{?>
                                            <td><?php echo ''; ?></td>
                                            <td>
                                                <div class="aktivita">
                                                    <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                    <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                    <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                    <p><?php echo $vyuka[pozn]; ?></p>
                                                </div>
                                            </td>
                                            <?php
                                            $poc = 9;
                                        }
                                        break;
                                    case 10:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 10;
                                        $help = 1;
                                        break;
                                    case 11:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 11;
                                        $help = 1;
                                        break;
                                    case 12:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 12;
                                        $help = 1;
                                        break;
                                    case 13:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 13;
                                        $help = 1;
                                        break;
                                    case 14:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 14;
                                        $help = 1;
                                        break;
                                    case 15:
                                        if($help==1){$poc++;}
                                        for ($i = $poc; $i < $hodina; $i++) {?>
                                            <td><?php echo ''; ?></td><?php
                                        }?>
                                        <td>
                                            <div class="aktivita">
                                                <p><?php echo $vyuka[misto_setkani]; ?></p>
                                                <p><?php echo $hodina .' - '. $hodina2; ?></p>
                                                <p><?php echo 'Počet dětí: '. $vyuka[poc_deti]; ?></p>
                                                <p><?php echo $vyuka[pozn]; ?></p>
                                            </div>
                                        </td>
                                        <?php
                                        $poc = 15;
                                        $help = 1;
                                        break;
                                }

                                ?>
                            <?php endwhile; ?>
                    </tr>
                <?php endwhile; }?>
            </table>
        </div>
    </div>
</section>
</body>
</html>

