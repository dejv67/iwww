<?php include('phpFiles/login/db_login.php'); ?>

<!doctype html>
<html  lang="cz">


<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/layout.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <script src="https://api.mapy.cz/loader.js"></script>
  <script>Loader.load()</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Aron | Lyžařská škola </title>
</head>
<body>


<header>
  <nav id="nav">
    <a href="phpFiles/rezervace.php">Domů</a>
    <a href= "phpFiles/login/zak_rez.php">Nabídka-Ceník</a>
    <a href="#kontakt">Kontakt</a>
    <a href="#rezervace">Rezervace</a>
    <a href="phpFiles/login/login.php">Přihlásit/Registrovat</a>
  </nav>
</header>

<section id="hero">
  <div>
    <h1>Aron | Lyžařská škola pro vás.</h1>
    <a href="#rezervace">
      Rezervovat výuku
    </a>
  </div>
</section>


<main>


  <div class="center-wrapper">

      <h2><a id="nabidka" class="jumptarget">Nabídka</a></h2>
      <h3>Privátní výuka</h3>
      <table>
        <tr>
          <th>2 hodiny </th>
          <th>1000,- Kč/osoba</th>
        </tr>
        <tr>
          <th>4 hodiny </th>
          <th>1800,- Kč/osoba</th>
        </tr>
      </table>
      <p>+ osoba      200,-Kč/hodina</p>
      <h3>Rodinná výuka</h3>
      <table>
        <tr>
          <th>1 den </th>
          <th>900,- Kč/osoba</th>
        </tr>
        <tr>
          <th>2 dny </th>
          <th>1800,- Kč/osoba</th>
        </tr>
        <tr>
          <th>3 dny </th>
          <th>2250,- Kč/osoba</th>
        </tr>
        <tr>
          <th>4 dny </th>
          <th>2650,- Kč/osoba</th>
        </tr>
        <tr>
          <th>5 dnů </th>
          <th>2950,- Kč/osoba</th>
        </tr>
        <tr>
          <th>6 dnů </th>
          <th>2950,- Kč/osoba</th>
        </tr>
      </table>
      <p>+ den      450,-Kč/osoba</p>
      <h3>Půjčovna</h3>
      <table>
        <tr>
          <th>DNY </th>
          <th>1.</th>
          <th>2.</th>
          <th>3.</th>
          <th>4.</th>
          <th>5.</th>
          <th>6. (gratis)</th>
        </tr>
        <tr>
          <th>Ski set </th>
          <th>300,- Kč</th>
          <th>600,- Kč</th>
          <th>900,- Kč</th>
          <th>1200,- Kč</th>
          <th>1500,- Kč</th>
          <th>1500,- Kč</th>
        </tr>
        <tr>
          <th>Snowboard set </th>
          <th>300,- Kč</th>
          <th>600,- Kč</th>
          <th>900,- Kč</th>
          <th>1200,- Kč</th>
          <th>1500,- Kč</th>
          <th>1500,- Kč</th>
        </tr>
        <tr>
          <th>Helma </th>
          <th>50,- Kč</th>
          <th>100,- Kč</th>
          <th>150,- Kč</th>
          <th>200,- Kč</th>
          <th>250,- Kč</th>
          <th>250,- Kč</th>
        </tr>
      </table>

      <hr/>

      </div>

    </div>

  <div class="center-wrapper">
    <div>
      <h2> <a id="kontakt" class="jumptarget">Kontakt</a></h2>
      <div class="flex-wrap">
      <section>
        <address>
          Aron, s. r. o.<br/>
          Hlavní ulice 59<br/>
          Pec pod Sněžkou<br/>
          Česká republika<br/>
          +420 657 867 254<br/>
          Email: <a href="mailto:aron@skischool.com">aron@skischool.com</a><br/>
        </address>
        <br/>
        <p>Otevírací doba:</p>
        <address>
        PO - PÁ: 8-17<br/>
        SO, NE: 7:30-18<br/>
        </address>

      </section>

      <section>
        <div id="mapa" style="width:600px; height:250px;"></div>
        <script type="text/javascript">
            var stred = SMap.Coords.fromWGS84(15.7390536, 50.6958517);
            var mapa = new SMap(JAK.gel("mapa"), stred, 17);
            mapa.addDefaultLayer(SMap.DEF_BASE).enable();
            mapa.addDefaultControls();

            var layer = new SMap.Layer.Marker();
            mapa.addLayer(layer);
            layer.enable();

            var options = {
                title: "Aron-SkiSchool"
            };
            var marker = new SMap.Marker(stred, "myMarker", options);
            layer.addMarker(marker);
        </script>
      </section>
      </div>
    </div>
    <hr/>
  </div>

  <div class="center-wrapper">
      <?php require_once  'phpFiles/objednavka.php';?>
      <div>
      <h2><a id="rezervace" class="jumptarget">Rezervace výuky</a></h2>
        <form action=phpFiles/objednavka.php method="POST">
      <p>jméno a příjmení:</p>
      <input type="text" name="name"/>
      <p>e-mail:</p>
      <input type="text" name="mail"/>

      <div class="flex-wrap2">
        <section>
          <p>od:</p>
          <input type="date" name="date_from"/>
        </section>
        <section>
          <p>do:</p>
          <input type="date" name="date_to"/>
        </section>
      </div>
      <br>
      <div>
        <section>
      <select name="tools">
        <option value="ski">lyže</option>
        <option value="snb">snowboard</option>
      </select>
        </section>
       <br>
        <section>
      <select name="lesson">
        <option value="priv1">Privátní výuka | 2h</option>
        <option value="priv2">Privátní výuka | 4h</option>
        <option value="rod">Rodinná výuka</option>
      </select>
        </section>
      </div>

      <p>počet dětí:</p>
      <input type="number" name="countKids" min="0" max="5"/>
      <p>jména dětí:</p>
      <input type="text" name="namesKids"/>
      <p>poznámka:</p>
      <textarea rows="4" cols="50" name="note"></textarea>
      <br/>
            <button type="submit" name="send" class="button">Odeslat</button>
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
        </form>
    </div>
  </div>

</main>
<footer>
  <div class="full-width-wrapper">

    <div class="flex-wrap">

    <section>
      <p>Copyleft
        2018                -
        2019 <a href="https://github.com">David</a></p>
    </section>

  </div>
  </div>
</footer>


</body>
</html>
