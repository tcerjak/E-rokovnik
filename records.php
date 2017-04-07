<?php
require 'core.php';
$aktivni_korisnik_id = $_SESSION['aktivni_korisnik_id'];
$query_r = query_r("SELECT * FROM rokovnik WHERE korisnik_id=$aktivni_korisnik_id");
if(isset($_GET['delete_id'])){
    $record_id = $_GET['delete_id'];
    query("DELETE FROM rokovnik WHERE rokovnik_id='$record_id'");
    header('Location:records.php');
}
?>
<!DOCTYPE html>
<html>
<?php require 'head.php'; ?>
<style type="text/css">
    .ui-datepicker {
        width: 44em;
    }
</style>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php require 'navigation.php'; ?>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">
                            <?php
                            echo "Zapisi za ".$_SESSION['aktivni_korisnik_ime'];
                            ?>
                        </h1>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Update User Section -->
    <!-- User Section -->
    <section id="about" class="container-fluid content-section text-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <img src="http://placehold.it/250x250"  width="250" height="250" style="padding-bottom: 20px;">
                <!-- Forma za pronalazak po danu, mjesecu -->
                <div class="table-responsive">
                    <form method="POST" action="">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th> Vidi zapise za:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="radio" name="pogled" value="danas"
                                        checked <?php if (isset($_POST['pogled']) && $_POST['pogled'] == 'danas') {
                                            echo ' checked="checked"';

                                        } ?> onclick="this.form.submit();"> Danas
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                     <input type="radio" name="pogled"
                                     value="mjesec" <?php if (isset($_POST['pogled']) && $_POST['pogled'] == 'mjesec') {
                                        echo ' checked="checked"';
                                    } ?> onclick="this.form.submit();"> Ovaj mjesec
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <input type="radio" name="pogled"
                                   value="godina" <?php if (isset($_POST['pogled']) && $_POST['pogled'] == 'godina') {
                                    echo ' checked="checked"';
                                } ?> onclick="this.form.submit();"> Ovu godinu &nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Datum unosa zapisa</th>
                <th>Vrijeme</th>
                <th>Tip događaja</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['pogled'])) {
                $pogled = $_POST['pogled'];
                switch ($pogled) {
                    case  $pogled == 'danas':
                    $datum = date('Y-m-d');
                    $upit_izvuci_zapise = "SELECT rokovnik_id, datum, vrijeme, vrsta_dogadaja.naziv as vrsta_dogadaja FROM rokovnik, vrsta_dogadaja WHERE korisnik_id ='4' AND rokovnik.vrsta_id = vrsta_dogadaja.vrsta_id AND datum = '$datum' order by vrijeme desc";
                    break;
                    case $pogled == 'mjesec':
                    $datum = date('m');
                    $upit_izvuci_zapise = "SELECT rokovnik_id, datum, vrijeme, vrsta_dogadaja.naziv as vrsta_dogadaja FROM rokovnik, vrsta_dogadaja WHERE korisnik_id ='$aktivni_korisnik_id' AND rokovnik.vrsta_id = vrsta_dogadaja.vrsta_id  AND month(datum) = '$datum' order by vrijeme desc";
                    $rezultat_upita = query_r($upit_izvuci_zapise);
                    break;
                    case $pogled == 'godina':
                    $datum = date('Y');
                    $upit_izvuci_zapise = "SELECT rokovnik_id, datum, vrijeme, vrsta_dogadaja.naziv as vrsta_dogadaja FROM rokovnik, vrsta_dogadaja WHERE korisnik_id ='$aktivni_korisnik_id' AND rokovnik.vrsta_id = vrsta_dogadaja.vrsta_id AND year(datum) = '$datum' order by vrijeme desc";
                    $rezultat_upita = query_r($upit_izvuci_zapise);
                    break;
                }
            } else {
                $datum = date('Y-m-d');
                $upit_izvuci_zapise = "SELECT rokovnik_id, datum, vrijeme, vrsta_dogadaja.naziv as vrsta_dogadaja FROM rokovnik, vrsta_dogadaja WHERE korisnik_id ='$aktivni_korisnik_id' AND rokovnik.vrsta_id = vrsta_dogadaja.vrsta_id AND datum = '$datum' order by vrijeme desc";
            }
            $rezultat_upita = query_r($upit_izvuci_zapise);
            foreach ($rezultat_upita as $red_BP) {
                list($rokovnik_id, $datum, $vrijeme, $vrsta_dogadaja) = $red_BP;
                echo "<tr class='border_bottom'>
                <td>$datum</td>
                <td>$vrijeme</td>
                <td>$vrsta_dogadaja</td>
                <td><a href='update_insert_records.php?id=$rokovnik_id' class='uredi_zapis'>Uredi</a></td>
            </tr>";
        }
        if (empty($rezultat_upita)) {
            echo "<tr><td colspan='6' align='center'><b><i>Nema unesenih zapisa za navedeni datum $datum</i></b></td></tr>";
        }
        ?>
    </tbody>
</table>
</div>
</div>
</div>
</section>
<?php require 'js_script.php'; ?>
</body>
</html>
