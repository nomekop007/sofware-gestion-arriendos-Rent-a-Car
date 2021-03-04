<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pendientes</h5>

            </div>
            <div class="modal-body">
                <br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {


        (cargarRecepcionCliente = async () => {
            const response = await ajax_function(null, "revisar_recepcionUsuario");
            console.log(response);
            $("#staticBackdrop").modal("show");
        })();


    });
</script>