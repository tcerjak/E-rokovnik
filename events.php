<?php
require 'core.php';
if ($_SESSION['aktivni_korisnik_tip'] == 1 || $_SESSION['aktivni_korisnik_tip'] ==2 ) {
    header('Location:index.php');
}
$query_r = query_r("SELECT * FROM `vrsta_dogadaja`");
if(isset($_GET['delete_id'])){
    $event_id = $_GET['delete_id'];
    query("DELETE from vrsta_dogadaja WHERE vrsta_id='$event_id'");
    header('Location:events.php');
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
                        <h1 class="brand-heading">DOGAĐAJI</h1>
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
                <img src="img/event.png"  width="250" height="250"">
                <hr>
                 <div class="well well-sm">
                    <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Naziv</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query_r as $result){
                        list($id, $naziv) = $result;
                        echo
                        "<tr>
                        <td>$id</td>
                        <td>$naziv</td>
                        <td><a class='btn btn-primary' href='update_insert_events.php?id=$id'>Ažuriraj</a></td>
                        <td><a class='btn btn-danger' href='events.php?delete_id=$id'>Obriši</a></td>
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
