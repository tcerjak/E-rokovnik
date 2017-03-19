<?php
require 'core.php';
$korisnik_id = $_SESSION['aktivni_korisnik_id'];
$query_r = query_r("SELECT * FROM rokovnik WHERE korisnik_id=$korisnik_id");
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
                <img src="http://placehold.it/250x250"  width="250" height="250"">
                <hr>
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
                    if (!empty($query_r)) {
                        foreach ($query_r as $row) {
                            list($rokovnik_id, $korisnik_id, $zemlja_id, $vrsta_id, $datum, $vrijeme, $opis, $praznik_id) = $row;
                            $tip_dogadaja_query = query("SELECT naziv FROM vrsta_dogadaja WHERE vrsta_id = $vrsta_id");
                            $tip_dogadaja = mysqli_fetch_assoc($tip_dogadaja_query);
                            echo "
                            <tr>
                             <td>$datum</td>
                             <td>$vrijeme</td>
                             <td>".$tip_dogadaja['naziv']."</td>
                             <td><a class='btn btn-primary' href='update_insert_records.php?id=$rokovnik_id'>Pregled zapisa</a></td>
                             <td><a class='btn btn-danger' href='records.php?delete_id=$rokovnik_id'>Obriši</a></td>
                         </tr>";
                     }
                 } else echo "<tr><td colspan='3' class='text-center'><strong><h3>Nema unesenih zapisa</h3></strong></td></tr>";
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
