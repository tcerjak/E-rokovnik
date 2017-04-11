<?php
require 'core.php';
$korisnik_id = $_SESSION['aktivni_korisnik_id'];
if (isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $query_r = query_r("SELECT * FROM rokovnik WHERE rokovnik_id = '$record_id'");
    foreach ($query_r as $row) {
        list($rokovnik_id, $korisnik_id, $zemlja_id, $vrsta_id, $datum, $vrijeme, $opis, $praznik_id) = $row;
    }
}
//-----------------------------AZURIRANJE----------------------------------------//
if (isset($_POST['update_record']) && !empty($_POST['update_record'])) {
    $rokovnik_id = $_POST['update_record'];
     $time = $_POST['time'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $event = $_POST['event'];
    $description = $_POST['description'];
    $dateArray = explode('-', $date);
    $run_query = query("SELECT praznik_id FROM praznik WHERE zemlja_id='$location' AND dan='$dateArray[2]' AND mjesec='$dateArray[1]'");
    $result_holiday = mysqli_fetch_assoc($run_query);
    $holiday_id = $result_holiday['praznik_id'];
    if (empty($holiday_id)) {
        query("UPDATE rokovnik set korisnik_id = $korisnik_id, zemlja_id = $location, vrsta_id = $event, datum='$date', vrijeme='$time', opis='$description' WHERE rokovnik_id = $rokovnik_id");
        header('Location:records.php');
    } else {
           query("UPDATE rokovnik set korisnik_id = $korisnik_id, zemlja_id = $location, vrsta_id = $event, datum='$date', vrijeme='$time', opis='$description', praznik_id=$holiday_id WHERE rokovnik_id = $rokovnik_id");
           header('Location:records.php');
    }
}
//---------------------------------DODAVANJE NOVOG ZAPISA--------------------//
if (!isset($_GET['id']) && isset($_POST['update_record']) && empty($_POST['update_record'])) {
    $time = $_POST['time'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $event = $_POST['event'];
    $description = $_POST['description'];
    $dateArray = explode('-', $date);
    $run_query = query("SELECT praznik_id FROM praznik WHERE zemlja_id='$location' AND dan='$dateArray[2]' AND mjesec='$dateArray[1]'");
    $result_holiday = mysqli_fetch_assoc($run_query);
    $holiday_id = $result_holiday['praznik_id'];
    if (empty($holiday_id)) {
        query("INSERT INTO rokovnik (korisnik_id, zemlja_id, vrsta_id, datum, vrijeme, opis) VALUES ('$korisnik_id', '$location', '$event', '$date', '$time', '$description')");
        header('Location:records.php');
    } else {
        query("INSERT INTO rokovnik (korisnik_id, zemlja_id, vrsta_id, datum, vrijeme, opis, praznik_id) VALUES ('$korisnik_id', '$location', '$event', '$date', '$time', '$description', '$holiday_id')");
        header('Location:records.php');
    }
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
                            if (isset($_GET['id'])) {
                                echo "Ažuriranje zapisa";
                            } else echo "Dodavanje zapisa";
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
                <img src="img/rokovnik.png"  width="250" height="250"">
                <hr>
                <form method="POST" action="update_insert_records.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group input-group clockpicker">
                        <input type="text" name="time" class="form-control" value="<?php if (!isset($_GET['id'])) {
                            echo date('H:i');
                        } else echo "$vrijeme"; ?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                    </div>
                    <div class="form-group input-group">
                        <input type="text" name="date" id="datum" class="form-control" value="<?php if (!isset($_GET['id'])) {
                            echo date('Y-m-d');
                        } else echo "$datum";?>">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    <div class="form-group">
                    <label for="location" class="col-2 col-form-label">Lokacija</label>
                    <select name="location" id="location" class="form-control scrollable-menu">
                        <?php
                        $locations = query_r("SELECT zemlja_id, naziv FROM zemlja");
                        foreach ($locations as $location) {
                            list($country_id, $naziv) = $location;
                            if($country_id == $zemlja_id){
                                echo "<option value='$country_id' selected>$naziv</option>";
                            } else echo "<option value='$country_id'>$naziv</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="event" class="col-2 col-form-label">Događaj</label>
                    <select name="event" id="event" class="form-control scrollable-menu">
                        <?php
                        $events = query_r("SELECT * FROM vrsta_dogadaja");
                        foreach ($events as $event) {
                            list($dogadaj_id, $naziv) = $event;
                            if ($dogadaj_id == $vrsta_id) {
                                echo "<option value='$dogadaj_id' selected>$naziv</option>";
                            }
                            echo "<option value='$dogadaj_id'>$naziv</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-2 col-form-label">Opis</label>
                        <textarea name="description" id="description" class="form-control" rows="7" required="required"><?php if (isset($_GET['id'])) {
                            echo $opis;
                        } ?></textarea>
                    </div>
                    <br>
                    <input type="hidden" name="update_record"  class="form-control" value="<?php if (isset($_GET['id'])) {
                        echo $_GET['id'];
                    } ?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
