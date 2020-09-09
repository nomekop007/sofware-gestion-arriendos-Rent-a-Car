</div>
<br><br>
</div>
</main>


</div>
</div>



<script>
// Script para validar los campos del formulario 
(() => {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();


//formatear rut
function formateaRut(rut) {
    //onblur="this.value=formateaRut(this.value)"
    var actual = rut.replace(/^0+/, "");
    if (actual != '' && actual.length > 1) {
        var sinPuntos = actual.replace(/\./g, "");
        var actualLimpio = sinPuntos.replace(/-/g, "");
        var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
        var rutPuntos = "";
        var i = 0;
        var j = 1;
        for (i = inicio.length - 1; i >= 0; i--) {
            var letra = inicio.charAt(i);
            rutPuntos = letra + rutPuntos;
            if (j % 3 == 0 && j <= inicio.length - 1) {
                rutPuntos = "." + rutPuntos;
            }
            j++;
        }
        var dv = actualLimpio.substring(actualLimpio.length - 1);
        rutPuntos = rutPuntos + "-" + dv;
    }
    return rutPuntos;

}

// Script para cargar vigencia Empresa
(() => {
    var n = (new Date()).getFullYear()
    var select = document.getElementById("inputVigencia");
    for (var i = n; i >= 1970; i--) select.options.add(new Option(i, i));
})();

//cambia el tab cliente de acuerdo al tipo de arriendo
(tipoArriendo = () => {
    var a = $("#inputTipo option:selected").val();
    if (a == 1) {
        $('#titulo_empresa').hide();
        $('#form_empresa').hide();
        $('#form_carnet_empresa').hide();
        $('#titulo_cliente').show();
        $('#form_cliente').show();

        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();


    } else if (a == 2) {
        $('#titulo_cliente').show();
        $('#form_cliente').show();
        $('#titulo_empresa').show();
        $('#form_empresa').show();

        $('#form_carnet_empresa').show();
        $('#form_comprobante_cliente').show();
        $('#form_licencia_conducir').show();
        $('#form_carnet_cliente').show();


    } else {
        $('#titulo_cliente').hide();
        $('#form_cliente').hide();
        $('#form_carnet_cliente').hide();
        $('#form_comprobante_cliente').hide();
        $('#titulo_empresa').show();
        $('#form_empresa').show();

    }
})();




$("#btn-arriendo").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-cliente").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-conductor").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
$("#btn-vehiculo").click(function() {
    $(this).toggleClass("btn-dark btn-outline-dark");
});
</script>

<!-- importaciones del select2 -->
<script src="<?php echo base_route() ?>/assets/js/select2.min.js"></script>

<!-- importaciones del arriendos -->
<script src="<?php echo base_route() ?>/assets/js/session_gestion/js_module_arriendos.js"></script>