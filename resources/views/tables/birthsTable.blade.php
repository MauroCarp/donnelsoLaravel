<table class="table table-bordered table-striped dt-responsive birthTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Caravana Madre</th>
            <th>Fecha Parto</th>
            <th>Caravana Macho reproductor</th>
            <th>Caravana Hijos</th>
            <th>Sexo</th> 
            <th>Mellizos</th> 
            <th>Cant.</th> 
            <th>Muertos</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($births as $birth)

            @if($birth->mother->type == $type)    

                <tr>
                    <td>{{ $birth->motherCaravan }}</td>
                    <td>{{ $birth->date }}</td>
                    <td>
                        @if($birth->maleCaravan != '')

                            {{ $birth->maleCaravan }}

                        @else

                        <div class="input-group">

                            <select class="form-control reproductiveCaravans" id="maleCaravan{{ $birth->id }}">

                                @foreach ($malesByType[$type] as $male)
                                    <option value="{{ $male['id'] }}">{{ $male['caravan'] }}</option>
                                @endforeach

                            </select>

                            <div class="input-group-append">

                                <div class="input-group-text"><button class="btn btn-success btnUpdateMaleCaravan" idSelect='maleCaravan{{ $birth->id }}'><i class="fa fa-check"></i></button></div>

                            </div>

                        </div>

                            

                        @endif
                    </td>
                    <td>{{ $birth->childrenCaravans }}</td>
                    <td>{{ ($birth->sex == 'm') ? 'Macho' : (($birth->sex == 'f') ? 'Hembra' : 'Macho / Hembra') }}</td>
                    <td>@if($birth->twins) <i class="fa fa-check text-success"></i>@else <i class="fa fa-times text-danger"></i>@endif</td>
                    <td>{{ $birth->amount }}</td>
                    <td>{{ $birth->deaths }}</td>

                    <td>

                        <form action="births/{{ $birth->id }}" method="POST" id="deleteBirthForm{{$birth->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteBirth" type="submit" form="deleteBirthForm{{$birth->id}}"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach
        
    </tbody>

</table>