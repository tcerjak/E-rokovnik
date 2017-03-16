<?php
require 'core.php';
if (isset($_GET['id'])) {
    $country_id = $_GET['id'];
    $query_r = query_r("SELECT * FROM praznik WHERE zemlja_id = $country_id");
    $name_country = query_r("SELECT naziv FROM zemlja WHERE zemlja_id = $country_id");
}
if(isset($_GET['delete_id'])){
    $holiday_id = $_GET['delete_id'];
    $country_id = $_GET['country_id'];
    query("DELETE from praznik WHERE praznik_id='$holiday_id'");
    header("Location:country_holiday.php?id=$country_id");
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
                        <h1 class="brand-heading">Pregled praznika za zemlju <?php if(isset($_GET['id'])){echo $name_country[0][0];} ?></h1>
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
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Naziv</th>
                        <th>Dan</th>
                        <th>Mjesec</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($query_r as $row) {
                        list($praznik_id, $zemlja_id, $naziv, $dan, $mjesec) = $row;
                        echo "
                        <tr>
                            <td>$naziv</td>
                            <td>$dan</td>
                            <td>$mjesec</td>
                            <td><a class='btn btn-primary' href='update_insert_holidays.php?id=$praznik_id&country_id=$country_id'>Ažuriraj</a></td>
                            <td><a class='btn btn-danger' href='country_holiday.php?delete_id=$praznik_id&country_id=$zemlja_id'>Obriši</a></td>
                        </tr>";
                    }
                ?>
                </tbody>
        </table>
        <hr style=" display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
        <a class='btn btn-primary btn-block' href='update_insert_holidays.php?country_id=<?php echo $country_id; ?>'>Dodaj</a>
    </div>
</div>
</div>
</section>
<?php require 'js_script.php'; ?>
</body>
</html>
