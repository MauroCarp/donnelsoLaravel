<table class="table table-bordered table-striped dt-responsive animalTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Caravana</th>
            <th>Sexo</th> 
            <th>Destino</th>
            <th>Edad</th>
            <th>Peso</th> 
            <th></th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($animals as $animal)
            @if($animal->type == $type)    
                <tr>
                    <td>{{ $animal->caravan }}</td>
                    <td>@if($animal->sex == 'm') Macho @else Hembra @endif</td>
                    <td>
                        @if ($animal->destination == 'reproductive')
                            Reproductor                            
                        @else
                            {{ ucfirst($animal->destination) }}
                        @endif
                    </td>
                    <td>{{ $animal->age ?? '-' }}</td>
                    <td>{{ $animal->weight }}</td>
                    <td>

                        @if($animal->idPurchase != null)
                            <button class="btn btn-info">Compra {{ $animal->idPuchase }}</button>
                        @endif

                        @if($animal->idBirth != null)

                            <button class="btn btn-info">Nacimiento {{ $animal->idBirth }}</button>

                        @endif

                        @if($animal->idHealth != null)

                            <button class="btn btn-info">Nacimiento {{ $animal->idHealth }}</button>

                        @endif

                    </td>

                    <td>

                        <form action="animals/{{ $animal->id }}" method="POST" id="updateAnimalForm{{$animal->id}}">

                            @csrf
                            @method('PATCH')
                            <button class="btn btn-warning btnUpdateAnimal" type="submit" form="updateAnimalForm{{$animal->id}}">
                                <i class="fa fa-edit"></i>
                            </button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach

    </tbody>

</table>