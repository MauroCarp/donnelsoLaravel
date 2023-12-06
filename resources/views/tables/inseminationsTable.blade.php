<table class="table table-bordered table-striped dt-responsive serviceTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Madres</th>
            <th>Fecha Inseminaci&oacute;n</th>
            <th>Posible Fecha de Parto</th>
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($inseminations as $insemination)

            @if($insemination->type == $type)    
                @php
                
                    $days = ($type == 'cerdo') ? 20 : 25;

                @endphp
                <tr>
                    <td>{{ implode(' - ',$insemination->caravans) }}</td>
                    <td>{{ date('d-m-Y',strtotime($insemination->date)) }}</td>
                    <td>{{ date('d-m-Y',strtotime($insemination->date->addDays($days))) }}</td>
                    <td>

                        <form action="inseminations/{{ $insemination->id }}" method="POST" id="deleteInseminationForm{{$insemination->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteInsemination" type="submit" form="deleteInseminationForm{{$insemination->id}}"><i class="fa fa-times"></i></button>

                        </form>

                    </td>
                </tr>

            @endif
        @endforeach
        
    </tbody>

</table>