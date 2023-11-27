<div class="modal fade" id="{{ $idModal }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-{{$modalSize}}" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">{{ $modalTitle }}</h5>

            </div>

            <div class="modal-body">

                @yield('modalContent')

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                
            </div>

        </div>

    </div>

</div>

