<?php 
require 'core.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $korisnik_id = $_GET['id'];
    $query_r = query_r("SELECT korisnik_id, tip_id, korisnicko_ime, lozinka, ime, prezime, email FROM korisnik WHERE korisnik_id = $korisnik_id");
    foreach ($query_r as $row) {
        list($korisnik_id, $tip_id, $korisnicko_ime, $lozinka, $ime, $prezime, $email) = $row;
    }
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
                        <h1 class="brand-heading">Ažuriranje korisnika</h1>
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
                <img src="http://placehold.it/250x250"  width="250" height="250""> 
                <hr>               
                <form method="POST" action="update_insert_user.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <label for="username" class="col-2 col-form-label">Korisničko ime</label>
                        <input type="text" class="form-control input-lg" id="username" placeholder="Korisničko ime" value="<?php if(isset($_GET['id'])){echo $korisnicko_ime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Lozinka</label>
                        <input type="password" class="form-control input-lg" id="pwd" placeholder="Lozinka" value="<?php if(isset($_GET['id'])){echo $lozinka;}?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Ime</label>
                        <input type="text" class="form-control input-lg" id="first-name" placeholder="Ime" value="<?php if(isset($_GET['id'])){echo $ime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Prezime</label>
                        <input type="text" class="form-control input-lg" id="last-name" placeholder="Prezime" value="<?php if(isset($_GET['id'])){echo $prezime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email" class="form-control input-lg" id="email" placeholder="Email" value="<?php if(isset($_GET['id'])){echo $email;}?>">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Ažuriraj</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>