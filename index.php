<?php
require 'core.php';
?>
<!DOCTYPE html>
<?php require 'head.php'; ?>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <?php require 'navigation.php'; ?>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Zabilježite trenutak</h1>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- About Section -->
    <section id="about" class="container-fluid content-section text-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2>O aplikaciji</h2>
                <img src="img/pencil-icon.png"  width="250" height="250">
                <hr>
                <p>Aplikacija zabilježite trenutak je jednostavna aplikacija koja omogućuje korisnicima bilježenje značajnih datuma koji su bitni u njihovim životima i potrebno ih je obilježiti. Smatramo da je u današnje vrijeme vremensko upravljanje odnosno „time management“ izuzetno bitna stavka i ovom aplikacijom želimo omogućiti bolje upravljanje vremenom.</p>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="container-fluid content-section text-center">
        <div class="row">
         <div class="col-md-4 col-md-offset-4">
            <h2>Kontaktirajte nas</h2>
            <img src="img/paper-plane.png"  width="250" height="250">
            <hr>
            <p>Slobodno nas kontaktirajte preko GitHub-a ili preko web aplikacije moj tvz.</p>
            <ul class="list-inline banner-social-buttons">
                <li>
                    <a href="https://moj.tvz.hr/" target="__blank" class="btn btn-default btn-lg"><img src="img/TVZ.png" height="90px" width="90px"></a>
                </li>
                <li>
                    <a href="https://github.com/tcerjak/E-rokovnik" target="__blank" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw fa-4x"></i></a>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php require 'js_script.php'; ?>

</body>

</html>
