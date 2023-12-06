@extends('modals/modal',['idModal' => 'modalService','modalTitle'=>'Nuevo Servicio','modalSize'=>'md'])

@section('modalContent')

<form action="services" method="POST" id="newServiceForm">
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
            
                <label for="date">Fecha Inicio:</label>
                
                <input type="date" name="startDate" id="startDate" class="form-control" required> 
                
            </div>
            
        </div>
     
        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="date">Fecha Fin:</label>
                
                <input type="date" name="endDate" id="endDate" class="form-control" required> 
                
            </div>
            
        </div>
    
    </div>

    <div class="row">

        <div class="col-xs-12 col-lg-12">
            
            <div class="form-group">
            
                <label for="males">Machos: <i class="fa fa-sync-alt rotating d-none" id="loaderMales"></i></label><br>
            
                <select name="idMales[]" id="idMales" required>

                </select>
            
            </div>

        </div>
    
    </div>

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-primary btn-block" type="submit" form="newServiceForm" id="btnNewService" name="btnNewService">Cargar Servicio</button>

@endsection