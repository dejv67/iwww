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
        <a href="login.php">Přihlásit/Registrovat</a>
    </nav>
</header>


<section >
    <div id="login">
        <H2>Registrace</H2>
    </div>

    <form method="post" action="registrace.php">
        <?php include('log_errors.php'); ?>
        <div class="input-group">
            <label>Jméno</label>
            <input type="text" name="name" value="<?php echo $name?>"/>
        </div>
        <div class="input-group">
            <label>Příjmení</label>
            <input type="text" name="surname" value="<?php echo $surname?>"/>
        </div>
        <div class="input-group">
            <label>telefon</label>
            <input type="text" name="phone" value="<?php echo $phone?>"/>
        </div>
        <div class="input-group">
            <label>e-mail</label>
            <input type="text" name="mail" value="<?php echo $mail?>"/>
        </div>
        <div class="input-group">
            <label>heslo</label>
            <input type="password" name="password"/>
        </div>
        <div class="input-group">
            <label>potvrďte heslo</label>
            <input type=password name="password2"/>
        </div>
        <div class="input-group">
            <button type="submit" name="reg" class="btn">Registrovat</button>
        </div>
        <div>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="error success">
                    <h3>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </h3>


                </div>
            <?php endif ?>
        </div>
        <a href="login.php">Přihlásit se</a>
    </form>

</section>



</body>
</html>