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
        <a href="#">Profil</a>
        <a href="zak_rez.php">Seznam rezervací</a>
        <a href="../../index.php?logout='1'">Odhlásit</a>
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
        $result = $mysqli->query("SELECT * FROM zakaznik WHERE email='$uz_id'") or die($mysqli->error);

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
    </div>
    <?php endif ?>



</body>
</html>
