 <!-- jQuery -->
 <script src="vendor/jquery/jquery.js"></script>

 <!-- Bootstrap Core JavaScript -->
 <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

 <!-- Plugin JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

 <!-- Theme JavaScript -->
 <script src="js/grayscale.min.js"></script>
 <script type="text/javascript" src="assets/js/highlight.min.js"></script>
 <script type="text/javascript" src="dist/bootstrap-clockpicker.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript" src="assets/js/highlight.min.js"></script>
 <!-- Lokalizacija datuma-->
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>

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
                //----------------------------
                var elements_t = document.getElementsByTagName("TEXTAREA"); // namještavanje required polja
                for (var t = 0; t < elements_t.length; t++) {
                    elements_t[t].oninvalid = function (e) {
                        e.target.setCustomValidity("");
                        if (!e.target.validity.valid) {
                            e.target.setCustomValidity("Molimo vas ispunite navedeno polje");
                        }
                    };
                    elements[t].oninput = function (e) {
                        e.target.setCustomValidity("");
                    };
                }
                //------------------------
            });

    $.datepicker.setDefaults(
        $.extend(
            $.datepicker.regional['hr']
            )
        );
    $("#datum").datepicker({dateFormat: 'yy-mm-dd'});
    // uredivanje datepickera
    $( "#datum" ).datepicker({
        inline: true,
        showOtherMonths: true
    })
    .datepicker('widget').wrap('<div class="ll-skin-latoja"/>');
    //-----------------------------------//
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Odaberi vrijeme'
    });
</script>
