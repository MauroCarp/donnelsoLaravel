@extends('modals/modal',['idModal' => 'modalPurchase','modalTitle'=>'Nueva Compra','modalSize'=>'md'])

@section('modalContent')

<form action="purchases" method="POST" id="newPurchaseForm">
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
            
                <label for="date">Fecha:</label>
                
                <input type="date" name="date" id="date" class="form-control" required> 
                
            </div>
            
        </div>

        <div class="col-xs-12 col-lg-6" id="amount" style="display:none;">
            
            <div class="form-group">
            
                <label for="amount">Cantidad:</label>
            
                <input type="number" id="amount" name="amount" value="0" class="form-control">
            
            </div>

        </div>
    
    </div>

    <div class="row" id="amountMaleFemale">

        <div class="col-xs-6 col-lg-6">
            
            <div class="form-group">
            
                <label for="males">Machos:</label>
            
                <input type="number" id="males" name="males" value="0" class="form-control">
            
            </div>

        </div>

        <div class="col-xs-6 col-lg-6">
            
            <div class="form-group">
            
                <label for="females">Hembras:</label>
            
                <input type="number" id="females" name="females" value="0" class="form-control">
            
            </div>

        </div>
    
    </div>
    
    <div class="row">

        <div class="col-xs-8 col-lg-6">
            
            <div class="form-group">
            
                <label for="idProvider">Proveedor: </label><br>
                
                <select id="idProvider" name="idProvider">

                    <option value="">Seleccionar Proveedor</option>

                    @foreach ($providers as $provider)
                    
                        <option value="{{$provider['id']}}">{{$provider['name']}}</option>

                    @endforeach

                    <option value="other">Otro</option>

                </select>
                
                <br>
                <br>
                <input type="text" id="newProvider" name="newProvider" class="form-control" placeholder="Proveedor" style="display:none;"/>
            
            </div>

        </div>

        <div class="col-xs-4 col-lg-6">
            
            <div class="form-group">
            
                <label for="destination">Destino: </label>
                <br>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="radioFaena" value="faena" name="destination" checked>
                    <label for="radioFaena" class="custom-control-label">Faena</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="radioEngorde" value="engorde" name="destination">
                    <label for="radioEngorde" class="custom-control-label">Engorde</label>
                </div>
               
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="radioReproductor" value="reproductor" name="destination">
                    <label for="radioReproductor" class="custom-control-label">Reproductor</label>
                </div>
                
            
            </div>

        </div>
    
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-6">
            
            <div class="form-group">
            
                <label for="cost">Precio Total:</label>
            
                <input type="number" step="0.01" id="cost" name="cost" class="form-control" value="0" required>
            
            </div>

        </div>
        
        <div class="col-xs-12 col-lg-6">
            
            <div class="form-group">
            
                <label for="kg">Kg Total:</label>
            
                <input type="number" step="0.100" id="kg" name="kg" class="form-control" value="0" required>
            
            </div>

        </div>

    </div>

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-success btn-block" type="submit" form="newPurchaseForm" id="btnNewPurchase" name="btnNewPurchase">Cargar Compra</button>

@endsection