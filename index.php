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
                <p>Grayscale is a free Bootstrap 3 theme created by Start Bootstrap. It can be yours right now, simply download the template on <a href="http://startbootstrap.com/template-overviews/grayscale/">the preview page</a>. The theme is open source, and you can use it for any purpose, personal or commercial.</p>
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
            <p>Feel free to email us to provide some feedback on our templates, give us suggestions for new templates and themes, or to just say hello!</p>
            <ul class="list-inline banner-social-buttons">
                <li>
                    <a href="https://moj.tvz.hr/" class="btn btn-default btn-lg"><img src="img/TVZ.png" height="90px" width="90px"></a>
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
