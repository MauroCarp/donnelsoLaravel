<table class="table table-bordered table-striped dt-responsive serviceTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Fecha Comienzo</th>
            <th>Fecha Fin</th>
            <th>Caravanas Machos</th>
            <th>Hembras</th>
            <th>Estado</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($services as $service)

            @if($service->type == $type)    

                <tr>
                    <td>{{ date('d-m-Y',strtotime($service->startDate)) }}</td>
                    <td>{{ date('d-m-Y',strtotime($service->endDate)) }}</td>
                    <td>{{ implode(' - ',$service->caravans) }}</td>
                    <td>{{ $service->idMothers }}</td>
                    <td><button idService="{{ $service->id }}" class="btnStateService badge  @if($service->state) bg-success">Activo @else bg-danger">Inactivo @endif</button></td>

                    <td>

                        <form action="services/{{ $service->id }}" method="POST" id="deleteServiceForm{{$service->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteService" type="submit" form="deleteServiceForm{{$service->id}}"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>

            @endif
        @endforeach
        
    </tbody>

</table>