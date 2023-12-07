<table class="table table-bordered table-striped dt-responsive deathTable" width="100%">
         
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
                    <td>{{ $dead->date }}</td>
                    <td>{{ $dead->motivo }}</td>
                    <td>{{ $dead->date }}</td>
                    <td>{{ ($dead->sex == 'm') ? 'Macho' : (($dead->sex == 'f') ? 'Hembra' : 'Macho / Hembra') }}</td>
                    <td>@if($dead->twins) <i class="fa fa-check text-success"></i>@else <i class="fa fa-times text-danger"></i>@endif</td>
                    <td>{{ $dead->amount }}</td>
                    <td>{{ $dead->deads }}</td>

                    <td>

                        <form action="deads/{{ $dead->id }}" method="POST" id="deletedeadForm{{$dead->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeletedead" type="submit" form="deletedeadForm{{$dead->id}}"><i class="fa fa-times"></i></button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach

    </tbody>

</table>