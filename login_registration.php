<?php
require 'core.php';
if (isset($_POST['username'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = safe_insert($_POST['username']);
        $password = safe_insert($_POST['password']);
        $result = query_r("SELECT * FROM korisnik WHERE korisnicko_ime = '$username' AND lozinka = '$password'");
        if ($result) {
            foreach ($result as $row_BP) {
                list($korisnik_id, $tip_id, $korisnicko_ime, $lozinka, $ime, $prezime, $email) = $row_BP;
                $_SESSION['aktivni_korisnik'] = $korisnicko_ime;
                $_SESSION['aktivni_korisnik_ime'] = $ime . " " . $prezime;
                $_SESSION['aktivni_korisnik_id'] = $korisnik_id;
                $_SESSION['aktivni_korisnik_tip'] = $tip_id;
            }
            header('Location: index.php');
        } else {
            $greska = "Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
        }
    } else {
        $greska = "Molimo Vas ispunite navedena polja";
    }
}
?>
<!DOCTYPE html>
<html>
<?php require 'head.php'; ?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php require 'navigation.php'; ?>
    <!-- login section -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 bg-info login">
                        <h2>Prijava</h2>
                        <img src="img/login-key.png" width="250" height="250">
                        <hr>
                        <form method="POST" action="login_registration.php">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="username" type="text" class="form-control" name="username"
                                placeholder="Korisničko ime">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password"
                                placeholder="Lozinka">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Potvrdi">
                        </form>
                        <br>
                        <?php
                        if (isset($greska)) {
                            echo "<div class='panel panel-danger'>
                            <div class='panel-heading'>Upozorenje</div>
                            <div class='panel-body' style='color:red;''>
                                $greska
                            </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Registration section -->
    <section id="about" class="container-fluid content-section text-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2>Registracija</h2>
                <img src="img/registration.png" width="250" height="250">
                <hr>
                <p>Ukoliko niste prijavljeni na sustav registracija je potrebna</p>
                <form style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" id="username" placeholder="Korisničko ime">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-lg" id="pwd" placeholder="Lozinka">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-lg" id="pwd-repeat" placeholder="Potvrda lozinke">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" id="first-name" placeholder="Ime">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" id="last-name" placeholder="Prezime">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-lg" id="email" placeholder="Email">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>