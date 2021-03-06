<?php
require 'core.php';
if ($_SESSION['aktivni_korisnik_tip'] == 0) {
    $query_country = query_r("SELECT zemlja.zemlja_id, zemlja.naziv, zemlja.korisnik_id, korisnik.ime, korisnik.prezime FROM zemlja, korisnik WHERE zemlja.korisnik_id = korisnik.korisnik_id ");
}
if(isset($_GET['delete_id'])){
    $country_id = $_GET['delete_id'];
    query("DELETE FROM zemlja WHERE zemlja_id='$country_id'");
    header('Location:country.php');
}
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
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Države</h1>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- User Section -->
    <section id="about" class="container-fluid content-section text-center">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <img src="img/globe-flat.png"  width="250" height="250"">
                <hr>
                <div class="well well-sm">
                <!-- ADMINISTRATOR IZBORNIK -->
                <?php if ($_SESSION['aktivni_korisnik_tip'] == 0): ?>
                   <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Naziv države</th>
                        <th>Voditelj države</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query_country as $result){
                        list($country_id, $name_country, $user_id, $user_first_name, $user_last_name) = $result;
                        echo
                        "<tr>
                        <td>$country_id</td>
                        <td>$name_country</td>
                        <td>$user_first_name &nbsp; $user_last_name</td>
                        <td><a class='btn btn-primary' href='update_insert_countries.php?id=$country_id'>Ažuriraj</a></td>
                        <td><a class='btn btn-primary' href='country_holiday.php?id=$country_id'>Pregled praznika</a></td>
                        <td><a class='btn btn-danger' href='country.php?delete_id=$country_id'>Obriši</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
        <?php endif ?>
        <!-- MODERATOR IZBORNIK-->
        <?php if ($_SESSION['aktivni_korisnik_tip'] == 1):
            $korisnik_id = $_SESSION['aktivni_korisnik_id'];
            $query_country = query_r("SELECT * FROM zemlja WHERE korisnik_id = $korisnik_id");
        ?>
           <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Naziv države</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($query_country as $result){
                list($country_id, $name_country, $user_id) = $result;
                echo
                "<tr>
                <td>$country_id</td>
                <td>$name_country</td>
                <td><a class='btn btn-primary' href='update_insert_countries.php?id=$country_id'>Ažuriraj</a></td>
                <td><a class='btn btn-primary' href='country_holiday.php?id=$country_id'>Pregled praznika</a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<?php endif ?>
    </div>
</div>
</div>
</section>
<?php require 'js_script.php'; ?>
</body>
</html>
