<?php
require 'core.php';
if (isset($_GET['id'])) {
    $holiday_id = $_GET['id'];
    $query_r = query_r("SELECT * FROM praznik WHERE praznik_id = $holiday_id");
    foreach ($query_r as $row) {
        list($praznik_id, $zemlja_id, $naziv, $dan, $mjesec) = $row;
    }
}
//-------------------------------------------------------------------//
if(isset($_POST['holiday_id'])){
    if (isset($_POST['holiday_name'])) {
        if(!empty($_POST['holiday_name'])){
            $holiday_name = $_POST['holiday_name'];
            $day = $_POST['day'];
            $month = $_POST['month'];
            $holiday_id = $_POST['holiday_id'];
            $country_id = $_POST['country_id'];
            query("UPDATE praznik SET naziv='$holiday_name', dan='$day', mjesec='$month' WHERE praznik_id = '$holiday_id'");
            header("Location: country_holiday.php?id=$country_id");
        }
    }
}
//-----------------------------------------------------//
if(!isset($_GET['id']) && empty($_POST['holiday_id'])){
    if (isset($_POST['holiday_name'])) {
        $holiday_name = $_POST['holiday_name'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $country_id = $_POST['country_id'];
        query("INSERT INTO praznik VALUES ('', '$country_id', '$holiday_name', '$day', '$month')");
        header("Location: country_holiday.php?id=$country_id");
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
                            if(isset($_GET['id']) && isset($_GET['country_id'])){
                                echo "Ažuriranje praznika";
                            } else {
                                echo "Dodavanje praznika";
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
                <img src="img/holiday-icon.png"  width="250" height="250"">
                <hr>
                <form method="POST" action="update_insert_holidays.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <label for="holiday_name" class="col-2 col-form-label">Naziv praznika</label>
                        <input type="text" class="form-control input-lg" id="holiday_name" name="holiday_name" placeholder="Naziv praznika" required='required' value="<?php if(isset($_GET['id'])){echo $naziv;}?>">
                    </div>
                    <div class="form-group">
                    <label for="day" class="col-2 col-form-label">Dan</label>
                    <select name="day" id="day" class="form-control scrollable-menu" required="required">
                        <?php
                        for($i = 1; $i <=31; $i++){
                            if($dan == $i){
                                echo "<option value='$i' selected>$i</option>";
                            } else{
                                echo "<option value='$i'>$i</option>";
                            }
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="month" class="col-2 col-form-label">Mjesec</label>
                    <select name="month" id="month" class="form-control scrollable-menu" required="required">
                        <?php
                        for($i = 1; $i <=12; $i++){
                            if($mjesec == $i){
                                echo "<option value='$i' selected>$i</option>";
                            } else{
                                echo "<option value='$i'>$i</option>";
                            }
                        }
                        ?>
                    </select>
                    </div>
                    <input type="hidden" name="holiday_id" id="holiday_id" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
                     <input type="hidden" name="country_id" id="country_id" class="form-control" value="<?php if(isset($_GET['country_id'])){echo $_GET['country_id'];}?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
