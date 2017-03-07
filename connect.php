<?php 
define("server", "localhost");
define("BP", "e-rokovnik");
define("BP_korisnik", "root");
define("BP_lozinka", "");
$charset = "utf8";

$dbc = mysqli_connect(server, BP_korisnik, BP_lozinka, BP);
if(!$dbc)
{
	die("Problem kod povezivanje na poslužitelja! <br> Tip greške: " .mysqli_connect_errno());
}

if(!mysqli_set_charset($dbc, $charset))
{
	die ("Problem kod postavljanja znakova! <br> Tip greške: ".mysqli_error($dbc));
}
