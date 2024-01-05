<table class="table table-bordered table-striped dt-responsive animalTable" id="animalTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Caravana</th>
            <th>Sexo</th> 
            <th>Destino</th>
            <th>Edad</th>
            <th>Peso</th> 
            <th></th> 
        </tr> 

    </thead>

    <tbody>

        @foreach ($animals as $animal)
            @if($animal->type == $type)    
                <tr>
                    <td>

                        <span class="caravanText" id="caravanText{{ $animal->id }}" caravanText="{{ $animal->id }}" style="cursor:pointer">

                            {{ $animal->caravan ?? '-' }}

                        </span>

                        <input type="text" class="selectCaravan" id="caravan{{ $animal->id }}" style="display:none" value="{{ $animal->caravan }}">

                    </td>
                    <td>@if($animal->sex == 'm') Macho @else Hembra @endif</td>
                    <td>

                        <span class="destinationText" id="destinationText{{ $animal->id }}" destinationText="{{ $animal->id }}" style="cursor:pointer">

                            @if ($animal->destination == 'reproductive')
                            Reproductor                            
                            @else
                            {{ ucfirst($animal->destination) }}
                            @endif

                        </span>

                        <select class="selectDestination" id="destination{{ $animal->id }}" style="display:none">
                            <option value="RN" @if($animal->destination == 'RN') selected @endif >RN</option>
                            <option value="engorde" @if($animal->destination == 'engorde') selected @endif>Engorde</option>
                            <option value="reproductive" @if($animal->destination == 'reproductive') selected @endif>Reproductor</option>
                            <option value="faena" @if($animal->destination == 'faena') selected @endif>Faena</option>
                        </select>

                    </td>
                    <td>
                        <span class="ageText" id="ageText{{ $animal->id }}" ageText="{{ $animal->id }}" style="cursor:pointer">

                            {{ $animal->age ?? '-' }}

                        </span>

                        <input type="text" class="selectAge" id="age{{ $animal->id }}" style="display:none" value="{{ $animal->age }}">

                    </td>
                    <td>
                        <span class="weightText" id="weightText{{ $animal->id }}" weightText="{{ $animal->id }}" style="cursor:pointer">

                            {{ $animal->weight ?? '-' }}

                        </span>

                        <input type="text" class="selectWeight" id="weight{{ $animal->id }}" style="display:none" value="{{ $animal->weight }}">

                    </td>
                    <td>

                        @if($animal->idPurchase != null)
                            <button class="btn btn-info">Compra {{ $animal->idPuchase }}</button>
                        @endif

                        @if($animal->idBirth != null)

                            <button class="btn btn-info">Nacimiento {{ $animal->idBirth }}</button>

                        @endif

                        @if($animal->idHealth != null)

                            <button class="btn btn-info">Sanidad {{ $animal->idHealth }}</button>

                        @endif

                    </td>

                </tr>

            @endif

        @endforeach

    </tbody>

</table>