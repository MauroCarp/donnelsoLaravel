@extends('modals/modal',['idModal' => 'modalInsemination','modalTitle'=>'Nueva Inseminación','modalSize'=>'md'])

@section('modalContent')

<form action="inseminations" method="POST" id="newInseminationForm">
    @csrf           
    <div class='row'>
        
        <div class="col-xs-12 col-lg-5">
        
                <label for="type">Animal:</label><br>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="cerdo" checked/>
                    <i class="icon icon-cerdo"></i>
                </label>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="vaca"/>
                    <i class="icon icon-vaca"></i>
                </label>

        </div>

        <div class="col-xs-12 col-lg-5">

            <div class="row">

                <div class="col-xs-12 col-lg-6">

                    <div class="form-group">
            
                        <label for="date">Fecha Inseminaci&oacute;n:</label>
                        
                        <input type="date" name="date" id="date" class="form-control" required> 
                        
                    </div>

                </div>

                <div class="col-xs-12 col-lg-6">

                    <div class="form-group">
                
                        <label for="mothers">Madres: <i class="fa fa-sync-alt rotating d-none" id="loaderMothers"></i></label><br>
                    
                        <select name="idMothers[]" id="idMothers">
        
                        </select>
                    
                    </div>

                </div>

            </div>

        </div> 

    </div> 

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-success btn-block" type="submit" form="newInseminationForm" id="btnNewInsemintaion" name="btnNewInsemintaion">Cargar Inseminaci&oacute;n</button>

@endsection