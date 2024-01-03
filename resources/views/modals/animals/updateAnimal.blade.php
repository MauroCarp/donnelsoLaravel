@extends('modals/modal',['idModal' => 'modalAnimal','modalTitle'=>'Modificar Animal','modalSize'=>'lg'])

@section('modalContent')

<form action="animals" method="POST" id="updateAnimalForm" style="margin-bottom:0">
    @csrf        

    {{-- <div class='row'>
        
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

        <div class="col-xs-12 col-lg-4">

            <div class="form-group">
            
                <label for="caravan">Caravana:</label><br>
            
                <select name="caravan" id="caravans" required>

                </select>
            
            </div>
            
        </div>
     
        <div class="col-xs12 col-lg-4">

            <div class="form-group">
            
                <label for="date">Fecha Muerte:</label>
                
                <input type="date" name="date" id="date" class="form-control" required> 
                
            </div>
            
        </div>

        <div class="col-xs12 col-lg-4">

            <div class="form-group">
            
                <label for="motive">Motivo:</label><br>
                
                <select name="motive" id="motive" required>

                    <option value="">Seleccionar Motivo</option>

                    @foreach ($motives as $motive)
                        
                        <option value="{{$motive->name}}">{{$motive->name}}</option>

                    @endforeach

                    <option value="other">Otro</option>

                </select>                

            </div>

            <div class="form-group d-none" id="otherInput" >

                <label for="other">Otro Motivo:</label><br>

                <input type="text" class="form-control" name="other" id="other">

            </div>
            
        </div>
    
    </div> --}}

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-success btn-block" type="submit" form="updateAnimalForm" id="btnUpdateAnimal" name="btnUpdateAnimal">Modificar Animal</button>

@endsection