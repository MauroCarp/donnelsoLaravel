<div class="modal fade" id="modalPreSale" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Nueva Pre-Venta</h5>

            </div>

            <div class="modal-body">

                <form action="sales" method="POST" id="newPreSaleForm">
                    @csrf           
                    <div class='row'>
                        
                        <div class="col-lg-12">
                        
                                <label for="type">Animal:</label><br>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="type" class="d-none" value="cerdo" checked/>
                                    <i class="icon icon-cerdo"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="type" class="d-none" value="chivo"/>
                                    <i class="icon icon-chivo"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="type" class="d-none" value="ovino"/>
                                    <i class="icon icon-cordero"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="type" class="d-none" value="vaca"/>
                                    <i class="icon icon-vaca"></i>
                                </label>

                                <label style="font-size:1.6em;">
                                    <input type="radio" name="type" class="d-none" value="pollo"/>
                                    <i class="icon icon-pollo"></i>
                                </label>
                        
                        </div>

                    </div> 

                    <div class="row">

                        <div class="col-xs-12 col-lg-6">

                            <div class="form-group">
                            
                                <label for="deliveryDate">Fecha Entrega:</label>
                                
                                <input type="date" name="deliveryDate" id="deliveryDate" class="form-control" required> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-12 col-lg-6">
                            
                            <div class="form-group">
                            
                                <label for="client">Cliente:</label>
                            
                                <input type="text" id="client" name="client" class="form-control" required>
                            
                            </div>

                        </div>
                    
                    </div>

                    <div class="row">

                        <div class="col-xs-6 col-lg-4">

                            <div class="form-group">
                            
                                <label for="amountEntire">Entero:</label>
                                
                                <input type="number" min="0" name="amountEntire" id="amountEntire" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountHalf">Medio:</label>
                                
                                <input type="number" min="0" name="amountHalf" id="amountHalf" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountRibs">Costillar:</label>
                                
                                <input type="number" min="0" name="amountRibs" id="amountRibs" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                    
                    </div>

                    <div class="row">

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountShoulder">Paleta:</label>
                                
                                <input type="number" min="0" name="amountShoulder" id="amountShoulder" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountRearQuarter">1/4 Trasero:</label>
                                
                                <input type="number" min="0" name="amountRearQuarter" id="amountRearQuarter" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountHead">Cabeza:</label>
                                
                                <input type="number" min="0" name="amountHead" id="amountHead" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                    
                    </div>

                    <div class="row" id="inputOvinos" style="display:none">

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountGround">Picada:</label>
                                
                                <input type="number" min="0" name="amountGround" id="amountGround" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountMeat">Pulpa:</label>
                                
                                <input type="number" min="0" name="amountMeat" id="amountMeat" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                        <div class="col-xs-6 col-lg-4 inputAmount">

                            <div class="form-group">
                            
                                <label for="amountSalame">Salame:</label>
                                
                                <input type="number" min="0" name="amountSalame" id="amountSalame" class="form-control" value="0"> 
                                
                            </div>
                            
                        </div>

                    
                    </div>

                </form>

            </div>

            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                <button class="btn btn-success" type="submit" form="newPreSaleForm" id="btnNewSale" name="btnNewSale">Cargar Pre-Venta</button>
                
            </div>

        </div>

    </div>

</div>