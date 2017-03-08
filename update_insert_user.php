<?php
require 'core.php';
if (isset($_GET['id'])) {
    $korisnik_id = $_GET['id'];
    $query_r = query_r("SELECT korisnik_id, tip_id, korisnicko_ime, lozinka, ime, prezime, email FROM korisnik WHERE korisnik_id = $korisnik_id");
    foreach ($query_r as $row) {
        list($korisnik_id, $tip_id, $korisnicko_ime, $lozinka, $ime, $prezime, $email) = $row;
    }
}
//-------------------------------------------------------------------//
    if(isset($_POST['user_id'])){
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if(!empty($_POST['username']) && !empty($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $user_type = $_POST['user_type'];
                $user_id = $_POST['user_id'];
                query("UPDATE korisnik SET tip_id='$user_type', korisnicko_ime='$username', lozinka='$password', ime='$first_name', prezime='$last_name', email='$email' WHERE korisnik_id = '$user_id'");
                if ($_SESSION['aktivni_korisnik_id'] == $user_id) {
                    $_SESSION['aktivni_korisnik'] = $username;
                    $_SESSION['aktivni_korisnik_ime'] = $first_name . " " . $last_name;
                    $_SESSION['aktivni_korisnik_tip'] = $user_type;
                }
                header('Location: users.php');
            }
        }
    }
//-----------------------------------------------------//
if(!isset($_GET['id'])){
   if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    query("INSERT INTO korisnik VALUES ('', '$user_type','$username', '$password', '$first_name', '$last_name', '$email')");
    header('Location: users.php');
}
}
//-----------------------------------------------------//
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
                                echo "Dodavanje korisnika";
                            } else {
                                echo "Ažuriranje korisnika";
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
                <img src="http://placehold.it/250x250"  width="250" height="250"">
                <hr>
                <form method="POST" action="update_insert_user.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <label for="username" class="col-2 col-form-label">Korisničko ime</label>
                        <input type="text" class="form-control input-lg" id="username" name="username" placeholder="Korisničko ime" required='required' value="<?php if(isset($_GET['id'])){echo $korisnicko_ime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Lozinka</label>
                        <input type="password" class="form-control input-lg" id="pwd" name="password" placeholder="Lozinka" required='required' value="<?php if(isset($_GET['id'])){echo $lozinka;}?>">
                    </div>
                    <div class="form-group">
                        <label for="first-name">Ime</label>
                        <input type="text" class="form-control input-lg" id="first_name" name="first_name" placeholder="Ime" value="<?php if(isset($_GET['id'])){echo $ime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Prezime</label>
                        <input type="text" class="form-control input-lg" id="last-name" name="last_name" placeholder="Prezime" value="<?php if(isset($_GET['id'])){echo $prezime;}?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control input-lg" id="email" name="email" placeholder="Email" value="<?php if(isset($_GET['id'])){echo $email;}?>">
                    </div>
                    <div class="form-group">
                       <label for="user_type">Tip korisnika</label>
                       <select name="user_type" id="input" class="form-control input-lg">
                        <?php
                        $query_r = query_r("SELECT * FROM tip_korisnika");
                        foreach ($query_r as $row) {
                            list($tip_korisnika_id, $tip_korisnika_naziv) = $row;
                            if ($tip_id == $tip_korisnika_id) {
                                echo
                                "<option value='$tip_korisnika_id' selected>$tip_korisnika_naziv</option>";
                            } else {
                                echo "<option value='$tip_korisnika_id'>$tip_korisnika_naziv</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $_GET['id'];?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Ažuriraj</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
