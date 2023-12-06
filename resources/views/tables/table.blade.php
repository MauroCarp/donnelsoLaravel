<table class="table table-bordered table-striped dt-responsive serviceTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Fecha Comienzo</th>
            <th>Fecha Fin</th>
            <th>Caravanas Machos</th>
            <th>Estado</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($services as $service)

            <tr>
                <td>{{ date('d-m-Y',strtotime($service->startDate))}}</td>
                <td>{{ date('d-m-Y',strtotime($service->endDate))}}</td>
                <td>{{ explode(' - ',$service->idMales) }}</td>
                <td><span state="{{ $service->state }}" class="btnStateService badge  @if($service->state) bg-success">Activo @else bg-danger">Inactivo @endif</span></td>

                <td>

                    <form action="services/{{ $service->id }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btnDeleteService" type="submit"><i class="fa fa-times"></i></button>

                    </form>

                </td>
            </tr>

        @endforeach
        
    </tbody>

</table>