<div class="modal fade" id="modalFinalize" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Completar Venta</h5>

            </div>

            <div class="modal-body">

                <form action="sales/finalize" method="POST" id="finalizeSaleForm">
                    @csrf           
                    <div class='row'>
                        
                        <input type="hidden" name="idSale">

                        <div class="col-lg-12">
                        
                                <label for="typeFinalize">Animal:</label>

                                <label style="font-size:2em;">
                                    <i class="icon icon-cerdo" style="display:none"> Lechon </i>
                                </label>

                                <label style="font-size:2em;">
                                    <i class="icon icon-chivo" style="display:none"> Chivo </i>
                                </label>

                                <label style="font-size:2em;">
                                    <i class="icon icon-cordero" style="display:none;font-family:Verdana"> Cordero </i>
                                </label>

                                <label style="font-size:2em;">
                                    <i class="icon icon-vaca" style="display:none"> Vaca </i>
                                </label>

                                <label style="font-size:2em;">
                                    <i class="icon icon-pollo" style="display:none"> Pollo </i>
                                </label>
                        
                        </div>

                    </div> 
                    
                    <div class="row border-bottom border-success pb-1">

                        <div class="col-xs-6 col-lg-4 border-right border-success" style="display:none" id="inputEntireFinalize">

                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">Entero<br> 

                                        <strong><span id="amountEntireFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgEntire">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgEntire" id="kgEntire" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                              
                        </div>
    
                        <div class="col-xs-6 col-lg-4 border-right border-success" style="display:none" id="inputHalfFinalize">
    
                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">Medio<br> 

                                        <strong><span id="amountHalfFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgHalf">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgHalf" id="kgHalf" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                           
                        </div>
    
                        <div class="col-xs-6 col-lg-4" style="display:none" id="inputRibsFinalize">

                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">Costillar<br> 

                                        <strong><span id="amountRibsFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgRibs">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgRibs" id="kgRibs" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                            
                        </div>
    
                    
                    </div>
    
                    <div class="row pt-1">
    
                        <div class="col-xs-6 col-lg-4 border-right border-success" style="display:none" id="inputShoulderFinalize">

                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">Paleta<br> 

                                        <strong><span id="amountShoulderFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgShoulder">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgShoulder" id="kgShoulder" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                            
                        </div>
    
                        <div class="col-xs-6 col-lg-4 border-right border-success" style="display:none" id="inputRearQuarterFinalize">

                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">1/4 Trasero<br> 

                                        <strong><span id="amountRearQuarterFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgRearQuarter">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgRearQuarter" id="kgRearQuarter" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                            
                        </div>
    
                        <div class="col-xs-6 col-lg-4" style="display:none" id="inputHeadFinalize">

                            <div class="small-box bg-teal">

                                <div class="inner">

                                    <p style="font-weight: bolder; font-size: 1.5em;">Cabeza<br> 

                                        <strong><span id="amountHeadFinalize"></span></strong> <br>

                                        <div class="form-group">
                            
                                            <label for="kgHead">Kg:</label>
                                            
                                            <input type="number" step="0.01" name="kgHead" id="kgHead" class="form-control" value="0"> 
                                            
                                        </div>

                                    </p>

                                </div>

                            </div>
                            
                        </div>
    
                    
                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-between">
                
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <button class="btn btn-success btn-block" type="submit" form="finalizeSaleForm" id="btnFinalizeSale" name="btnFinalizeSale">Finalizar Venta</button>
                
            </div>

        </div>

    </div>

</div>