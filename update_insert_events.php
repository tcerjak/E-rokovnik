<?php
require 'core.php';
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $query_r = query_r("SELECT * FROM vrsta_dogadaja WHERE vrsta_id = $event_id");
    foreach ($query_r as $row) {
        list($event_id, $name_event) = $row;
    }
}
//-------------------------------------------------------------------//
if(isset($_POST['event_id'])){
    if (isset($_POST['event_name'])) {
        if(!empty($_POST['event_name'])){
            $event_name = $_POST['event_name'];
            $id = $_POST['event_id'];
            query("UPDATE vrsta_dogadaja SET naziv='$event_name' WHERE vrsta_id = '$id'");
            header('Location: events.php');
        }
    }
}
//-----------------------------------------------------//
if(!isset($_GET['id']) && empty($_POST['event_id'])){
    if (isset($_POST['event_name'])) {
    $event_name = $_POST['event_name'];
    query("INSERT INTO vrsta_dogadaja VALUES ('', '$event_name')");
    header('Location: events.php');
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
                                echo "Dodavanje događaja";
                            } else {
                                echo "Ažuriranje događaja";
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
                <form method="POST" action="update_insert_events.php" style="padding-bottom: 50px; text-align: left;">
                    <div class="form-group">
                        <label for="event_name" class="col-2 col-form-label">Naziv događaja</label>
                        <input type="text" class="form-control input-lg" id="event_name" name="event_name" placeholder="Naziv događaja" required='required' value="<?php if(isset($_GET['id'])){echo $name_event;}?>">
                    </div>
                    <input type="hidden" name="event_id" id="event_id" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Potvrdi</button>
                </form>
            </div>
        </div>
    </section>
    <?php require 'js_script.php'; ?>
</body>
</html>
