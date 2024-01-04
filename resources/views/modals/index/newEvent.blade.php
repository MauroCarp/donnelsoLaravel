<div class="modal fade" id="modalEvent" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Nuevo Evento</h5>

            </div>

            <div class="modal-body">

                <form action="events" method="post" id="formNewEvent">

                    @csrf

                    <div class="mb-3">
                      <label for="title" class="form-label">Evento</label>
                      <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                
                    <div class="mb-3">

                        <label for="start" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" name="start" id="start" required>

                    </div>

                    <div class="mb-3">
                      <label for="end" class="form-label">Fecha Fin</label>
                      <input type="date" class="form-control" name="end" id="end" required>
                    </div>
                
                </form>

            </div>

            <div class="modal-footer justify-content-between">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                <button type="submit" class="btn btn-success" form="formNewEvent" >Guardar</button>
                
            </div>

        </div>

    </div>

</div>
