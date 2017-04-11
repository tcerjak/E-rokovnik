<?php
require 'core.php';
if ($_SESSION['aktivni_korisnik_tip'] == 1 || $_SESSION['aktivni_korisnik_tip'] ==2 ) {
    header('Location:index.php');
}
$query_r = query_r("SELECT korisnik_id, tip_id, korisnicko_ime, lozinka, ime, prezime, email FROM korisnik");
if(isset($_GET['delete_id'])){
    $user_id = $_GET['delete_id'];
    query("DELETE from korisnik WHERE korisnik_id='$user_id'");
    header('Location:users.php');
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
                        <h1 class="brand-heading">Korisnici</h1>
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
                <img src="img/users-icon.png"  width="250" height="250"">
                <hr>
                <div class="well well-sm">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Korisničko ime</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>E-mail</th>
                        <th>Tip korisnika</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query_r as $result){
                        list($korisnik_id, $tip_id, $korisnicko_ime, $lozinka, $ime, $prezime, $email) = $result;
                        $query = query("SELECT tip_korisnika.naziv FROM tip_korisnika WHERE tip_korisnika.tip_id = $tip_id");
                        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
                        $tip_korisnika = $result['naziv'];
                        echo
                        "<tr>
                        <td>$korisnik_id</td>
                        <td>$korisnicko_ime</td>
                        <td>$ime</td>
                        <td>$prezime</td>
                        <td>$email</td>
                        <td>$tip_korisnika</td>
                        <td><a class='btn btn-primary' href='update_insert_user.php?id=$korisnik_id'>Ažuriraj</a></td>
                        <td><a class='btn btn-danger' href='users.php?delete_id=$korisnik_id'>Obriši</a></td>
                    </tr>";
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
