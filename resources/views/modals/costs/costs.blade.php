<div class="modal fade" id="modalCosts" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Tabla de Costos</h5>

            </div>

            <div class="modal-body">

                <form action="costs" method="POST" id="costForm">
                    @csrf           
                    <div class='row'>
                        
                        <div class="col-lg-12">
                        
                                <label for="type">Animal:</label><br>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="typeCost" class="d-none" value="cerdo" checked/>
                                    <i class="icon icon-cerdo"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="typeCost" class="d-none" value="chivo"/>
                                    <i class="icon icon-chivo"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="typeCost" class="d-none" value="ovino"/>
                                    <i class="icon icon-cordero"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="typeCost" class="d-none" value="vaca"/>
                                    <i class="icon icon-vaca"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="typeCost" class="d-none" value="pollo"/>
                                    <i class="icon icon-pollo"></i>
                                </label>

                                <i class="fa fa-sync-alt rotating" id="loaderCost" style="display:none;font-size:3em;margin-left:10px"></i>
                        
                        </div>

                        <div class="costInputs" id="costsCerdo" style="display:none">

                            @php

                                $type = 'cerdo';

                            @endphp

                            @include('modals/costs/costInputs')

                        </div>

                        <div class="costInputs" id="costsChivo" style="display:none">

                            @php

                                $type = 'chivo';

                            @endphp

                            @include('modals/costs/costInputs')

                        </div>

                        <div class="costInputs" id="costsOvino" style="display:none">

                            @php

                                $type = 'ovino';

                            @endphp

                            @include('modals/costs/costInputs')

                        </div>

                        <div class="costInputs" id="costsVaca" style="display:none">

                            @php

                                $type = 'vaca';

                            @endphp

                            @include('modals/costs/costInputs')

                        </div>

                        <div class="costInputs" id="costsPollo" style="display:none">

                            @php

                                $type = 'pollo';

                            @endphp

                            @include('modals/costs/costInputs')

                        </div>

                    </div> 

                </form>

            </div>

            <div class="modal-footer">

                <button class="btn btn-success btn-block" type="submit" form="costForm" id="btnCosts" name="btnCosts">Actualizar Costos</button>
                
            </div>

        </div>

    </div>

</div>