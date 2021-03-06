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
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tabulka instruktoři</title>
</head>
<body>
<header class="lista">
    <nav >
        <a href="plachta.php">Plachta</a>
        <a href= "rezervace.php">Rezervace</a>
        <a href="#">Instruktoři</a>
        <a href="zakaznici.php">Zákaznici</a>
        <?php if($uz_id=="admin"){
            ?><a href="uzivatele.php">Uživatelé</a><?php
        }?>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>

<?php require_once 'db_ins.php';?>      <!--pridani php procesu-->



<div class="container">
    <?php
    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM instruktor") or die($mysqli->error);
    //pre_r($result);           // nechat zakomentovany- k nicemu
    ?>


    <div class="row justify-content-between">
        <h2 style="margin-top: 80px;">Instruktoři</h2>
        <table class="table table-sm" style="margin-top: 10px;">
            <thead>
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>telefon</th>
                <th>e-mail</th>
                <th>účet</th>
                <th>nástroje</th>
                <th>jazyky</th>
                <th>plat</th>
                <th>poznámka</th>
                <th colspan="1">Action</th>
            </tr>
            </thead>
            <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row[jmeno]; ?></td>
                    <td><?php echo $row[prijmeni]; ?></td>
                    <td><?php echo $row[telefon]; ?></td>
                    <td><?php echo $row[email]; ?></td>
                    <td><?php echo $row[ucet]; ?></td>
                    <td><?php echo $row[nastroje]; ?></td>
                    <td><?php echo $row[jazyky]; ?></td>
                    <td><?php echo $row[plat]; ?></td>
                    <td><?php echo $row[poznamka]; ?></td>
                    <td>
                        <a href="instruktori.php?edit=<?php echo $row['id_instruktora'];?>"
                           class="btn btn-info">Upravit</a>
                        <a href="instruktori.php?delete=<?php echo $row['id_instruktora']; $_SESSION['del'] = $row['email'];?>"
                           class="btn btn-danger">Smazat</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <?php

    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>

    <div class="row justify-content-left">
        <form action="db_ins.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-inline">
                <label>jméno:</label>
                <input type="text" name="name" class="form-control"  value="<?php echo $name;?>" placeholder="Zadejte jméno">
            </div>
            <div class="form-inline">
                <label>příjmení:</label>
                <input type="text" name="surname" class="form-control" value="<?php echo $surname;?>" placeholder="Zadejte příjmení">
            </div>
            <div class="form-inline">
                <label>telefon:</label>
                <input type="text" name="tel" class="form-control"  value="<?php echo $tel;?>" placeholder="Zadejte tel. číslo">
            </div>
            <div class="form-inline">
                <label>e-mail:</label>
                <?php
                if($update == true):
                    ?>
                    <input type="text" name="mail" class="form-control" readonly>
                <?php else: ?>
                    <input type="text" name="mail" class="form-control" value="<?php echo $mail;?>" placeholder="Zadejte email">
                <?php endif; ?>
            </div>
            <div class="form-inline">
                <label>účet:</label>
                <input type="text" name="account" class="form-control" value="<?php echo $account;?>" placeholder="Zadejte číslo účtu">
            </div>
            <div class="form-inline">
                <label>nástroje:</label>
                <input type="text" name="tools" class="form-control" value="<?php echo $tools;?>" placeholder="Zadejte nástroje">
            </div>
            <div class="form-inline">
                <label>jazyky:</label>
                <input type="text" name="languages" class="form-control" value="<?php echo $languages;?>" placeholder="Zadejte jazyky">
            </div>
            <div class="form-inline">
                <label>plat:</label>
                <input type="number" name="salary" class="form-control" value="<?php echo $salary;?>" min="0" step="10">
            </div>
            <div class="form-inline">
                <label>poznámka:</label>
                <textarea rows="4" cols="50" name="note" class="form-control" value="<?php echo $note;?>" placeholder="Zadejte poznámku"></textarea>
            </div>
            <div class="form-inline">
                <?php
                if($update == true):
                    ?>
                    <input type="hidden" name="pass" class="form-control" value="<?php echo $pas;?>">
                <?php else: ?>
                    <label>heslo:</label>
                    <input type="password" name="pass" class="form-control" value="<?php echo $pas;?>">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <?php
                if($update == true):
                    ?>
                    <button type="submit" class="btn btn-info" name="update" style="padding: 20px 40px;">Upravit</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Uložit</button>
                <?php endif; ?>
            </div>
            <div>
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
            </div>
        </form>
    </div>
</div>
</body>