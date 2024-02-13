@extends('modals/modal',['idModal' => 'modalBill','modalTitle'=>'Nuevo Gasto','modalSize'=>'md'])

@section('modalContent')

<form action="bills" method="POST" id="newBillForm">
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

        <div class="col-xs-12 col-lg-6">

            <div class="form-group">
            
                <label for="billDate">Fecha:</label>
                
                <input type="date" name="billDate" id="billDate" class="form-control" required> 
                
            </div>
            
        </div>
     
        <div class="col-xs-6 col-lg-6">

            <div class="form-group">
            
                <label for="billAmount">Monto:</label>
                
                <input type="number" step="0.1" name="billAmount" id="billAmount" class="form-control" required> 
                
            </div>
            
        </div>
    
    </div>

    <div class="row">

        <div class="col-xs-12 col-lg-6">

            <div class="form-group">
            
                <label for="billDescription">Descripci&oacute;n:</label>
                
                <textarea class="form-control" name="billDescription" id="billDescription" cols="10" rows="5"></textarea>

            </div>
            
        </div>
     
        <div class="col-xs-6 col-lg-6">

            <div class="form-group">
            
                <label for="">Tipo de Gasto:</label><br>
                
                <select name="billType" id="billType" required>

                    <option value="general">General</option>

                    <option value="veterinarie">Veterinario</option>

                </select>
                            
            </div>
            
        </div>
    
    </div>

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-success" type="submit" form="newBillForm" id="btnNewBill" name="btnNewBill">Cargar Gasto</button>

@endsection