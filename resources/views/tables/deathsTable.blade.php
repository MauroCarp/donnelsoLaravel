<table class="table table-bordered table-striped dt-responsive deadTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Caravana</th>
            <th>Fecha Muerte</th>
            <th>Motivo</th>
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($deaths as $dead)
            @if($dead->type == $type)    
                <tr>
                    <td>{{ $dead->caravan }}</td>
                    <td>{{ date('d-m-Y',strtotime($dead->date)) }}</td>
                    <td>{{ $dead->motive }}</td>
                    <td>

                        <form action="deaths/{{ $dead->id }}" method="POST" id="deleteDeadForm{{$dead->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteDead" type="submit" form="deleteDeadForm{{$dead->id}}"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach

    </tbody>

</table>