<?php
require 'core.php';
if (isset($_GET['id'])) {
    $country_id = $_GET['id'];
    $query_r = query_r("SELECT * FROM zemlja WHERE zemlja_id = $country_id");
    foreach ($query_r as $row) {
        list($country_id, $country_name, $user_id) = $row;
    }
}
//---------------------------------------------//
if ($_SESSION['aktivni_korisnik_tip']==0) {
    if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
        $country_id = $_POST['country_id'];
        $country_name = $_POST['country_name'];
        $user_id = $_POST['moderator'];
        query("UPDATE zemlja SET korisnik_id=$user_id, naziv='$country_name' WHERE zemlja_id=$country_id");
        header('Location: country.php');
    }
} elseif ($_SESSION['aktivni_korisnik_tip']==1) {
    if(isset($_POST['country_id']) && !empty($_POST['country_id'])){
        $country_id = $_POST['country_id'];
        $country_name = $_POST['country_name'];
        query("UPDATE zemlja SET naziv='$country_name' WHERE zemlja_id=$country_id");
        header('Location: country.php');
    }
}
//--------------------------------------------//
if(!isset($_GET['id']) && empty($_POST['country_id'])){
    if(isset($_POST['moderator'])){
    $country_name = $_POST['country_name'];
    $user_id = $_POST['moderator'];
    query("INSERT INTO zemlja (zemlja_id, naziv, korisnik_id) VALUES ('', '$country_name', $user_id)");
    header('Location: country.php');
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
                        <h1 class="brand-heading">
                        <?php
                            if(!isset($_GET['id'])){
                                echo "Dodavanje zemlje";
                            } else {
                                echo "Ažuriranje zemlje";
                            }
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
                <img src="img/globe-flat.png"  width="250" height="250"">
                <hr>
                <form method="POST" action="update_insert_countries.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <label for="country_name" class="col-2 col-form-label">Naziv države</label>
                        <input type="text" class="form-control input-lg" id="country_name" name="country_name" placeholder="Naziv države" required='required' value="<?php if(isset($_GET['id'])){echo $country_name;}?>">
                    </div>
                    <?php if ($_SESSION['aktivni_korisnik_tip']==0): ?>
                        <div class="form-group">
                         <label for="moderator">Voditelj</label>
                         <select name="moderator" id="input" class="form-control input-lg">
                            <?php
                            $query_r = query_r("SELECT ime, prezime, korisnik_id FROM korisnik WHERE tip_id = 1");
                            foreach ($query_r as $row) {
                                list($ime, $prezime, $korisnik_id) = $row;
                                if($korisnik_id == $user_id){
                                    echo "<option value='$korisnik_id' selected>$ime $prezime</option>";
                                } else {
                                    echo "<option value='$korisnik_id'>$ime $prezime</option>";
                                }
                            }

                            ?>
                        </select>
                    </div>
                <?php endif ?>
                      <input type="hidden" name="country_id" id="country_id" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
