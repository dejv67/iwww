<!DOCTYPE html>
<html>
<head>
    <title>Tabulka instruktoři</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/instr.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</head>
<body>
    <?php //require_once  'process.php';?>      <!--pridani php procesu-->
    <div class="container">
    <?php
        //$mysqli = new mysqli('localhost', 'user', 'password', 'db_dev') or die(mysqli_error($mysqli));
        //$result = $mysqli->query("SELECT * FROM instruktor") or die($mysqli->error);
        //pre_r($result);           // nechat zakomentovany- k nicemu
        ?>

        <div class="row justify-content-center">
            <table class="table">
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
                    </tr>
                </thead>
                <?php
                    /*while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row[name]; ?></td>
                            <td><?php echo $row[surname]; ?></td>
                            <td><?php echo $row[tel]; ?></td>
                            <td><?php echo $row[mail]; ?></td>
                            <td><?php echo $row[account]; ?></td>
                            <td><?php echo $row[tools]; ?></td>
                            <td><?php echo $row[languages]; ?></td>
                            <td><?php echo $row[salary]; ?></td>
                            <td><?php echo $row[note]; ?></td>
                            <td></td>
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
    */?>

    <div class="row justify-content-center">
    <form action="process.php" method="post">
        <div class="form-inline">
            <label>jméno:</label>
            <input type="text" name="name" class="form-control" value="Zadejte jméno">
        </div>
        <div class="form-inline">
            <label>příjmení:</label>
            <input type="text" name="surname" class="form-control" value="Zadejte příjmení">
        </div>
        <div class="form-inline">
            <label>telefon:</label>
            <input type="text" name="tel" class="form-control"  value="Zadejte tel. číslo">
        </div>
        <div class="form-inline">
            <label>e-mail:</label>
            <input type="text" name="mail" class="form-control" value="Zadejte email">
        </div>
        <div class="form-inline">
            <label>účet:</label>
            <input type="text" name="account" class="form-control" value="Zadejte číslo účtu">
        </div>
        <div class="form-inline">
            <label>nástroje:</label>
            <input type="text" name="tools" class="form-control" value="Zadejte nástroje">
        </div>
        <div class="form-inline">
            <label>jazyky:</label>
            <input type="text" name="languages" class="form-control" value="Zadejte jazyky">
        </div>
        <div class="form-inline">
            <label>plat:</label>
            <input type="number" name="salary" class="form-control" min="0" step="10">
        </div>
        <div class="form-inline">
            <label>poznámka:</label>
            <input type="text" name="note" class="form-control" value="Zadejte poznámku">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="save">Uložit</button>
        </div>
    </form>
    </div>
    </div>
</body>