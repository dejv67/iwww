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
        <a href="#">Profil</a>
        <a href="vyuka.php">Výuka</a>
        <a href="/semestralka/src/index.php?logout='1'">Odhlásit</a>
    </nav>
</header>
    <div id="login">
        <H2>Profil</H2>
    </div>

    <?php
    // zjistit id a dat ho do $id

    if(isset($_SESSION["username"])):
        $uz_id = $_SESSION['username'];

        $mysqli = new mysqli('db', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM instruktor WHERE email='$uz_id'") or die($mysqli->error);

        if (count($result)==1){
            $row = $result->fetch_array();
        }

        ?>
        <div class="content">
            <h2> <?php echo $row['jmeno'] .' '.$row['prijmeni']?></h2>
            <p>tel.: </p>
            <h4><?php echo $row['telefon']?></h4>
            <p>e-mail: </p>
            <h4><?php echo $row['email']?></h4>
            <p>bankovní účet: </p>
            <h4><?php echo $row['ucet']?></h4>
            <p>nástroje: </p>
            <h4><?php echo $row['nastroje']?></h4>
            <p>jazyky: </p>
            <h4><?php echo $row['jazyky']?></h4>
            <p>plat: </p>
            <h4><?php echo $row['plat']?></h4>
            <p>poznámka: </p>
            <h4><?php echo $row['poznamka']?></h4>
        </div>
    <?php endif ?>




</body>
</html>