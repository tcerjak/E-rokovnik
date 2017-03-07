<?php 
require 'core.php';
$query_r = query_r("SELECT korisnik_id, tip_id, korisnicko_ime, lozinka, ime, prezime, email FROM korisnik");
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
            <div class="col-md-4 col-md-offset-4">
                <img src="img/users-icon.png"  width="250" height="250""> 
                <hr>               
                <div class="table-responsive">          
                  <table class="table">
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
                        list($korisnik_id, $tip_id, $korisnicko_ime, $ime, $prezime, $email) = $result;
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