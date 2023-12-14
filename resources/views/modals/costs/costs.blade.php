<div class="modal fade" id="modalCosts" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">

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
                        
                        <div class="row border-bottom border-success border-top pb-1 mt-1">

                            <div class="col-xs-6 col-lg-4 border-right border-success">
    
                                <label for="costEntire">Entero:</label>
                                
                                <div class="input-group">                    
                                                    
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costEntire" id="costEntire" class="form-control" value="0"> 

                                </div>
                                 
                            </div>
        
                            <div class="col-xs-6 col-lg-4 border-right border-success">
        
                                <label for="costHalf">Medio:</label>
                                
                                <div class="input-group">                    
                                                        
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costHalf" id="costHalf" class="form-control" value="0"> 

                                </div>
    
                            </div>
        
                            <div class="col-xs-6 col-lg-4">
    
                                <label for="costRibs">Costillar:</label>
                                
                                <div class="input-group">                    
                                                            
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costRibs" id="costRibs" class="form-control" value="0"> 

                                </div> 
                                
                            </div>
        
                        
                        </div>
        
                        <div class="row py-1 border-bottom border-success">
        
                            <div class="col-xs-6 col-lg-4 border-right border-success">

                                <label for="costShoulder">Paleta:</label>
                                
                                <div class="input-group">                    
                                                                
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costShoulder" id="costShoulder" class="form-control" value="0"> 

                                </div>                                    

                            </div>
        
                            <div class="col-xs-6 col-lg-4 border-right border-success">
                        
                                <label for="costRearQuarter">1/4 Trasero:</label>
                                
                                <div class="input-group">                    
                                                                    
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costRearQuarter" id="costRearQuarter" class="form-control" value="0"> 

                                </div>
                                    
                            </div>
        
                            <div class="col-xs-6 col-lg-4">
    
                                <label for="costHead">Cabeza:</label>

                                <div class="input-group">                    
                                                                        
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costHead" id="costHead" class="form-control" value="0"> 

                                </div>
    
                            </div>
        
                        
                        </div>

                        <div class="row pt-1">
        
                            <div class="col-xs-6 col-lg-4 border-right border-success">

                                <label for="costMatadero">Matadero:</label>
                                
                                <div class="input-group">                    
                                                                
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costMatadero" id="costMatadero" class="form-control" value="0"> 

                                </div>                                    

                            </div>
        
                            <div class="col-xs-6 col-lg-4 border-right border-success">
                        
                                <label for="costAdmin">Admin:</label>
                                
                                <div class="input-group">                    
                                                                    
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

                                    </div>

                                    <input type="number" step="0.01" name="costAdmin" id="costAdmin" class="form-control" value="0"> 

                                </div>
                                    
                            </div>
        
                            <div class="col-xs-6 col-lg-4">
    
                                <label for="percentageEmployed">% Empleado:</label>

                                <div class="input-group">                    
                                                                        
                                    <div class="input-group-prepend">

                                        <span class="input-group-text"><b>%</b></span>

                                    </div>

                                    <input type="number" step="0.01" name="percentageEmployed" id="percentageEmployed" class="form-control" value="0"> 

                                </div>
    
                            </div>
        
                        
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