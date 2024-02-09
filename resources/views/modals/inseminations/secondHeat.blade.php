<div class="modal fade" id="modalSecondHeat" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">2do Celo</h5>

            </div>

            <div class="modal-body">

                <form action="services" method="POST" id="secondHeatForm">
                    @csrf           
                    <div class='row'>
                
                        <div class="col-xs-12 col-lg-8">
                
                            <div class="row">
                
                                <div class="col-xs-12 col-lg-12">
                
                                    <div class="form-group">
                                
                                        <label for="mothersToService">Madres: <i class="fa fa-sync-alt rotating d-none" id="loaderMothersToService"></i></label><br>
                                    
                                        <select name="idMothersToService[]" id="idMothersToService">
                        
                                        </select>
                                    
                                    </div>
                
                                </div>
                
                            </div>
                
                        </div> 
                
                    </div> 
                
                </form>

            </div>

            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                <button class="btn btn-success" type="submit" form="newSecondHeatForm" id="btnSecondHeat" name="btnSecondHeat">Enviar a Servicio</button>
                
            </div>

        </div>

    </div>

</div>

