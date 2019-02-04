<?php include('db_login.php'); ?>

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

<header>
    <nav id="nav">
        <a href="../../index.php">Domů</a>
        <a href= "../../index.php#nabidka">Nabídka-Ceník</a>
        <a href="../../index.php#kontakt">Kontakt</a>
        <a href="../../index.php#rezervace">Rezervace</a>
        <a href="#">Přihlásit/Registrovat</a>
    </nav>
</header>


<section >
    <div id="login">
        <H2>Přihlášení</H2>
    </div>

    <form method="post" action="login.php">
        <?php include('log_errors.php'); ?>
        <div class="input-group">
            <label>e-mail</label>
            <input type="text" name="mail"/>
        </div>
        <div class="input-group">
            <label>heslo</label>
            <input type="password" name="password"/>
        </div>
        <div class="input-group">
            <button type="submit" name="log" class="btn">Přihlásit</button>
        </div>
        <a href="registrace.php">Registrovat se</a>
    </form>

</section>


</body>
</html>