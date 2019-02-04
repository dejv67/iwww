<?php include('login/db_login.php');

/*if(empty($_SESSION['username'])){
    header('location: login/login.php');
}*/

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabulka uživatelé</title>
    <link rel="stylesheet" type="text/css" href="../css/kancl.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">


</head>
<body>
<header class="lista">
    <nav id="nav">
        <a href="plachta.php">Plachta</a>
        <a href= "rezervace.php">Rezervace</a>
        <a href="instruktori.php">Instruktoři</a>
        <a href="zakaznici.php">Zákaznici</a>
        <a href="#">Uživatelé</a>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>

<?php require_once 'db_uziv.php';?>      <!--pridani php procesu-->


<div class="container">
    <?php
    $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM uzivatel") or die($mysqli->error);

    ?>

    <div class="row justify-content-between">
        <h2 style="margin-top: 80px;">Uživatelé</h2>
        <table class="table table-sm" style="margin-top: 10px;">
            <thead>
            <tr>
                <th>Login</th>
                <th>Heslo</th>
                <th>id role</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row[login]; ?></td>
                    <td><?php echo $row[heslo]; ?></td>
                    <td><?php echo $row[uz_id_role]; ?></td>
                    <td>
                        <a href="uzivatele.php?edit=<?php echo $row['login']; ?>"
                           class="btn btn-info">Upravit</a>
                        <a href="uzivatele.php?delete=<?php echo $row['login']; ?>"
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
        <form action="db_uziv.php" method="POST">
            <div class="form-inline">
                <label>login:</label>
                <input type="text" name="login" class="form-control"  value="<?php echo $login;?>" placeholder="Zadejte login">
            </div>
            <div class="form-inline">
                <label>heslo:</label>
                <input type="text" name="heslo" class="form-control" value="<?php echo $pass;?>" placeholder="Zadejte heslo">
            </div>
            <div class="form-inline">
                <label>id role:</label>
                <input type="text" name="role" class="form-control"  value="<?php echo $role;?>" placeholder="Zadejte cislo role">
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
</div>
</body>