<table class="table table-bordered table-striped dt-responsive deadTable" width="100%">
         
    <thead>
     
        <tr>
            <th>Fecha</th>
            <th>Motivo</th>
            <th>Aplicaci&oacute;n</th>
            <th>Caravana</th>
            <th>Comentarios</th>
            <th>$ Vet</th>
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($health as $reg)
            @if($reg->type == $type)    
                <tr>
                    <td>{{ date('d-m-Y',strtotime($reg->date)) }}</td>
                    <td><td>
                    <td><td>
                    <td><td>
                    <td><td>
                    <td><td>
                    <td><td>
                    <td>

                        <form action="health/{{ $reg->id }}" method="POST" id="deleteHealthForm{{$reg->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteHealth" type="submit" form="deleteHealthForm{{$reg->id}}"><i class="fa fa-times"></i></button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach

    </tbody>

</table>