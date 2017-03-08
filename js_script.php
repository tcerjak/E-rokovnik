 <!-- jQuery -->
 <script src="vendor/jquery/jquery.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

 <!-- Plugin JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

 <!-- Theme JavaScript -->
 <script src="js/grayscale.min.js"></script>

 <script>
    $("document").ready(function(){
                var elements = document.getElementsByTagName("INPUT"); // namještavanje required polja
                for (var i = 0; i < elements.length; i++) {
                    elements[i].oninvalid = function (e) {
                        e.target.setCustomValidity("");
                        if (!e.target.validity.valid) {
                            e.target.setCustomValidity("Molimo vas ispunite navedeno polje");
                        }
                    };
                    elements[i].oninput = function (e) {
                        e.target.setCustomValidity("");
                    };
                }
            });
</script>
