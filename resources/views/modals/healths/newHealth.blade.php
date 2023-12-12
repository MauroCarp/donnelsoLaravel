@extends('modals/modal',['idModal' => 'modalHealth','modalTitle'=>'Nuevo Registro','modalSize'=>'md'])

@section('modalContent')

<form action="deaths" method="POST" id="newHealthForm" style="margin-bottom:0">
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

        </div>

    </div> 

    <div class="row">
     
        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="date">Fecha:</label>
                
                <input type="date" name="date" id="date" class="form-control" required> 
                
            </div>
            
        </div>

        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="motive">Motivo:</label><br>
                
                <select name="motive" id="motive" class="form-control" required>

                    <option value="">Seleccionar Motivo</option>
                    <option value="Desparacitacion">Desparacitaci&oacute;n</option>
                    <option value="Vacunacion">Vacunaci&oacute;n</option>
                    <option value="Tratamiento">Tratamiento</option>

                </select>                

            </div>

        </div>
    
    </div>

    <div class="row">
        
        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="aplication">Aplicaci&oacute;n:</label><br>
                
                <select name="aplication" id="aplication" class="form-control" required>

                    <option value="General">General</option>
                    <option value="Individual">Individual</option>

                </select>                

            </div>

        </div>

        <div class="col-xs-12 col-lg-6  d-none">

            <div class="form-group">
            
                <label for="caravan">Caravana:</label><br>
            
                <select name="caravan" id="caravan">

                </select>
            
            </div>
            
        </div>

    </div>
    
    <div class="row">

        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="comments">Comentarios:</label><br>
                
                <textarea name="comments" id="comments" rows="4"></textarea>

            </div>

        </div>

        <div class="col-xs12 col-lg-6">

            <label for="vetCost">$ Veterinario:</label><br>

            <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="number" step="0.10" id="vetCost" name="vetCost" class="form-control">

            </div>

        </div>

    </div>

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-primary btn-block" type="submit" form="newHealthForm" id="btnNewHealth" name="btnNewHealth">Cargar Registro</button>

@endsection