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
    <title>Tabulka zákazníci</title>
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <title>Aron | Lyžařská škola </title>
</head>
<body>

<header class="lista">
    <nav id="nav">
        <a href="plachta.php">Plachta</a>
        <a href= "rezervace.php">Rezervace</a>
        <a href="instruktori.php">Instruktoři</a>
        <a href="#">Zákaznici</a>
        <?php if($uz_id=="admin"){
            ?><a href="uzivatele.php">Uživatelé</a><?php
        }?>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>
<?php require_once 'db_zak.php';?>      <!--pridani php procesu-->

<?php

if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
        echo $_SESSION['message'];
        unset ($_SESSION['message']);

        ?>

    </div>
<?php endif ?>

<div class="container">
    <?php
    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM zakaznik") or die($mysqli->error);

    ?>

    <div class="row justify-content-between">
        <h2 style="margin-top: 80px;">Zákazníci</h2>
        <table class="table table-sm" style="margin-top: 10px;">
            <thead>
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>telefon</th>
                <th>e-mail</th>
                <?php if($uz_id=="admin"){?>
                <th colspan="2">Action</th>
                <?php }?>
            </tr>
            </thead>
            <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row[jmeno]; ?></td>
                    <td><?php echo $row[prijmeni]; ?></td>
                    <td><?php echo $row[telefon]; ?></td>
                    <td><?php echo $row[email]; ?></td>
                    <?php if($uz_id=="admin"){?>
                    <td>
                        <a href="zakaznici.php?edit=<?php echo $row['id_zakaznika'];?>"
                           class="btn btn-info">Upravit</a>
                        <a href="zakaznici.php?delete=<?php echo $row['id_zakaznika']; $_SESSION['del'] = $row['email']; ?>"
                           class="btn btn-danger">Smazat</a>
                    </td>
                    <?php }?>
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
    <?php if($uz_id=="admin"){?>
    <div class="row justify-content-left">
        <form action="db_zak.php" method="POST">
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
            <div class="form-group">
                <?php
                if($update == true):
                    ?>
                    <button type="submit" class="btn btn-info" name="update">Upravit</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary" name="save">Uložit</button>
                <?php endif; ?>
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
    </div>
    <?php }?>
</div>
</body>