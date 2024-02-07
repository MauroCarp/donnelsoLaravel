<div class="row border-bottom border-success border-top pb-1 mt-1">

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costEntire">Entero:</label>
        
        <div class="input-group">                    
                            
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costEntire{{ $type }}" id="costEntire{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" id="costEntireHist{{ $type }}" title="Historico Precio" section="entire" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>
            
    </div>

    @if($type != 'pollo' && $type != 'vaca')

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costHalf">Medio:</label>
        
        <div class="input-group">                    
                                
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costHalf{{ $type }}" id="costHalf{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="half" id="costHalfHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            

        </div>

    </div>

    <div class="col-xs-6 col-lg-4">

        <label for="costRibs">Costillar:</label>
        
        <div class="input-group">                    
                                    
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costRibs{{ $type }}" id="costRibs{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="ribs" id="costRibsHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>

        </div> 
        
    </div>

    @endif

</div>

@if($type != 'pollo' && $type != 'vaca')

<div class="row py-1 border-bottom border-success">

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costShoulder">Paleta:</label>
        
        <div class="input-group">                    
                                        
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costShoulder{{ $type }}" id="costShoulder{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="shoulder" id="costShoulderHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            

        </div>                                    

    </div>

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costRearQuarter">1/4 Trasero:</label>
        
        <div class="input-group">                    
                                            
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costRearQuarter{{ $type }}" id="costRearQuarter{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="rearQuarter" id="costRearQuarterHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>
            
    </div>

    <div class="col-xs-6 col-lg-4">

        <label for="costHead">Cabeza:</label>

        <div class="input-group">                    
                                                
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costHead{{ $type }}" id="costHead{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="head" id="costHeadHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>

    </div>


</div>

@endif

@if($type == 'ovino')

<div class="row py-1 border-bottom border-success">

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costGround">Picada:</label>
        
        <div class="input-group">                    
                                        
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costGround{{ $type }}" id="costGround{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="shoulder" id="costGroundHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            

        </div>                                    

    </div>

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costMeat">Pulpa:</label>
        
        <div class="input-group">                    
                                            
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costMeat{{ $type }}" id="costMeat{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="rearQuarter" id="costMeatHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>
            
    </div>

    <div class="col-xs-6 col-lg-4">

        <label for="costSalame">Salame:</label>

        <div class="input-group">                    
                                                
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costSalame{{ $type }}" id="costSalame{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="head" id="costSalameHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>

    </div>


</div>

@endif


<div class="row pt-1">

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costMatadero">Matadero:</label>
        
        <div class="input-group">                    
                                        
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costMatadero{{ $type }}" id="costMatadero{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="matadero" id="costMataderoHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>

        </div>                                    

    </div>

    <div class="col-xs-6 col-lg-4 border-right border-success">

        <label for="costAdmin">Admin:</label>
        
        <div class="input-group">                    
                                            
            <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

            </div>

            <input type="number" step="0.01" name="costAdmin{{ $type }}" id="costAdmin{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="admin" id="costAdminHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>
            
    </div>

    <div class="col-xs-6 col-lg-4">

        <label for="costEmployer">% Empleado:</label>

        <div class="input-group">                    
                                                
            <div class="input-group-prepend">

                <span class="input-group-text"><b>%</b></span>

            </div>

            <input type="number" step="0.01" name="costEmployer{{ $type }}" id="costEmployer{{ $type }}" class="form-control" value="0"> 
            
            <div class="input-group-append">

                <div class="input-group-text">

                    <button type="button" class="btn btn-primary btnHistorial" title="Historico Precio" section="employer" id="costEmployerHist{{ $type }}" style="padding:4px 10px"><i class="fa fa-list" style="font-size:.8em"></i></button>

                </div>

            </div>
            
        </div>

    </div>


</div>

                