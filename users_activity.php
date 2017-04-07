<?php
require 'core.php';
$result = query_r("SELECT korisnicko_ime, ime, prezime, tip_korisnika.naziv, korisnicke_aktivnosti.datum, korisnicke_aktivnosti.vrijeme from korisnik, korisnicke_aktivnosti, tip_korisnika where
  korisnik.korisnik_id = korisnicke_aktivnosti.korisnik_id AND korisnik.tip_id = tip_korisnika.tip_id ORDER BY datum DESC, vrijeme DESC");
  ?>
  <!DOCTYPE html>
  <html>
  <?php require 'head.php'; ?>
  <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php require 'navigation.php'; ?>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div>
                     <img src="img/activity.png"  width="250" height="250"">
                     <div class="well well-sm">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Korisničko ime</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Tip korisnika</th>
                                    <th>Datum prijave u sustav</th>
                                    <th>Vrijeme prijave u sustav</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $row) {
                                    list($username, $first_name, $last_name, $user_type, $date, $time) = $row;
                                    echo "<tr>
                                    <td>$username</td>
                                    <td>$first_name</td>
                                    <td>$last_name</td>
                                    <td>$user_type</td>
                                    <td>$date</td>
                                    <td>$time</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<?php require 'js_script.php'; ?>
</body>
</html>

