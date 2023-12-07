<table class="table table-bordered table-striped dt-responsive birthTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Madre</th>
            <th>Macho reproductor</th>
            <th>Fecha Parto</th>
            <th>Sexo</th> 
            <th>Mellizos</th> 
            <th>Cant.</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($births as $birth)

            @if($birth->type == $type)    

                <tr>
                    <td>{{ $birth->motherCaravan }}</td>
                    <td>{{ $birth->maleCaravan }}</td>
                    <td>{{ $birth->date }}</td>
                    <td>{{ $birth->sex }}</td>
                    <td>{{ $birth->twins }}</td>
                    <td>{{ $birth->amount }}</td>

                    <td>

                        <form action="births/{{ $birth->id }}" method="POST" id="deleteBirthForm{{$birth->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteBirth" type="submit" form="deleteBirthForm{{$birth->id}}"><i class="fa fa-times"></i></button>

                        </form>

                    </td>
                </tr>

            @endif
        @endforeach
        
    </tbody>

</table>