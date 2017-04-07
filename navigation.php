    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
            Sadržaj <i class="fa fa-bars"></i>
        </button>
        <?php
        if (!isset($_SESSION['aktivni_korisnik_id'])) {
            echo  "<a class='navbar-brand page-scroll' href='login_registration.php'>
            <i class='fa fa-thumbs-up'></i>
            <span class='light'>Prijava</span><div id='weather'></div>
        </a>";
    } else
    echo  "<a class='navbar-brand page-scroll' href='logaout.php'>
    <i class='fa fa-hand-spock-o'></i>
    <span class='light'>Odjava " .$_SESSION['aktivni_korisnik_ime']."</span><div id='weather'></div>
</a>";

?>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
  <ul class="nav navbar-nav">
    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
    <li class="hidden">
      <a href="#page-top"></a>
  </li>
  <?php
    $path = $_SERVER['PHP_SELF'];
    $filename = basename($path, ".php");
  if (!isset($_SESSION['aktivni_korisnik_id']) && $filename == "index") {
      echo "
      <li>
        <a class='page-scroll' href='#about'>O aplikaciji</a>
    </li>
    <li>
        <a class='page-scroll' href='#contact'>Kontakt</a>
    </li>";
} if (!isset($_SESSION['aktivni_korisnik_id']) && $filename == "login_registration") {
         echo "
      <li>
        <a class='page-scroll' href='#about'>Registracija</a>
    </li>
      <li>
        <a class='page-scroll' href='index.php'>Početna stranica</a>
    </li>";
}
if (isset($_SESSION['aktivni_korisnik_id'])) {
switch ( $_SESSION['aktivni_korisnik_tip']) {
  case 0:
  echo "
  <li>
    <div class='dropdown'>
      <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Korisnici
        <span class='caret'></span></button>
        <ul class='dropdown-menu'>
          <li><a href='users.php''>Pregled korisnika</a></li>
          <li><a href='update_insert_user.php'>Dodaj korisnika</a></li>
      </ul>
  </div>
</li>
<li>
<div class='dropdown'>
      <a href='users_activity.php' style='color:black;' class='btn btn-default'>Korisničke aktivnosti</a>
  </div>
</li>
<li>
  <div class='dropdown'>
    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Zemlja
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>
        <li><a href='country.php'>Pregled zemlja</a></li>
        <li><a href='update_insert_countries.php'>Dodaj zemlju</a></li>
    </ul>
</div>
</li>
<li>
    <div class='dropdown'>
      <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Događaji
        <span class='caret'></span></button>
        <ul class='dropdown-menu'>
          <li><a href='events.php'>Pregled događaja</a></li>
          <li><a href='update_insert_events.php'>Dodaj događaj</a></li>
      </ul>
  </div>
</li>
<li>
  <div class='dropdown'>
    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Rokovnik
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>
        <li><a href='records.php'>Pregled zapisa</a></li>
        <li><a href='update_insert_records.php'>Dodaj zapis</a></li>
    </ul>
</div>
</li>
";
break;
case 1:
echo "
<li>
  <div class='dropdown'>
    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Zemlja
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>
        <li><a href='country.php'>Pregled zemlja</a></li>
    </ul>
</div>
</li>
<li>
  <div class='dropdown'>
    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Rokovnik
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>
        <li><a href='records.php'>Pregled zapisa</a></li>
        <li><a href='update_insert_records.php'>Dodaj zapis</a></li>
    </ul>
</div>
</li>
";
break;
case 2:
echo "
<li>
  <div class='dropdown'>
    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown'>Rokovnik
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>
        <li><a href='records.php'>Pregled zapisa</a></li>
        <li><a href='update_insert_records.php'>Dodaj zapis</a></li>
    </ul>
</div>
</li>
";
break;
}
}
?>
</ul>
</div>
<!-- /.navbar-collapse -->
</div>
<!-- /.container -->
</nav>
