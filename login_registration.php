<?php
require 'core.php';
if (isset($_POST['username']) && !isset($_POST['registration'])) {
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
                $datum = date('Y-m-d');
                $vrijeme = date('H:i:s');
                query("INSERT INTO `korisnicke_aktivnosti` (`korisnik_id`, `datum`, `vrijeme`) VALUES ('$korisnik_id', '$datum', '$vrijeme')");
            }
            header('Location: index.php');
        } else {
            $greska = "Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
        }
    } else {
        $greska = "Molimo Vas ispunite navedena polja";
    }
}

if (isset($_POST['registration'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    if ($password == $repeat_password) {
        query("INSERT INTO korisnik (tip_id, korisnicko_ime, lozinka, ime, prezime, email) VALUES (2, '$username', '$password', '$first_name', '$last_name', '$email')");
        $obavijest = "Uspješno ste registrirani";
    } else {
        $obavijest = "Vaše lozinke se ne podudaraju";
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
                <form method="POST" action="login_registration.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control input-lg" id="username" placeholder="Korisničko ime" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-lg" id="pwd" placeholder="Lozinka" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repeat_password" class="form-control input-lg" id="pwd-repeat" placeholder="Potvrda lozinke" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control input-lg" id="first-name" placeholder="Ime">
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control input-lg" id="last-name" placeholder="Prezime">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control input-lg" id="email" placeholder="Email">
                    </div>
                    <input type="hidden" name="registration">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                    <br>
                    <?php if (isset($obavijest)): ?>
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><?php echo $obavijest; ?></strong>
                        </div>
                    <?php endif ?>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
