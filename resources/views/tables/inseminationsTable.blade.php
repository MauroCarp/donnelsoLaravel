<table class="table table-bordered table-striped dt-responsive inseminationsTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Madres</th>
            <th>Fecha Inseminaci&oacute;n</th>
            <th>Posible Fecha de Celo</th>
            <th>Posible Fecha de Parto</th>
            <th>Anotaciones</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($inseminations as $insemination)

            @if($insemination->type == $type)    
                @php
                
                    $heatDays = ($type == 'cerdo') ? 20 : 25;
                    $birthDays = ($type == 'cerdo') ? 20 : 25;
                    
                    $heatDate = new DateTime($insemination->date);
                    $heatDate->add(new DateInterval('P' . $heatDays . 'D'));
                    
                    $birthDate = new DateTime($insemination->date);
                    $birthDate->add(new DateInterval('P3M'));
                    $birthDate->add(new DateInterval('P3W'));
                    $birthDate->add(new DateInterval('P3D'));
                    
                @endphp

                <tr>
                    <td>{{ implode(' - ',$insemination->caravans) }}</td>
                    <td>{{ date('d-m-Y',strtotime($insemination->date)) }}</td>
                    <td>
                        {{ $heatDate->format('d-m-Y') }} 
                        <button class="btn btn-info float-right btnSecondHeat" data-toggle="modal" data-target="#modalSecondHeat" id="{{ $insemination->id }}"
                            caravans="{{ implode('-',$insemination->caravans) }}"
                            type="{{ $type }}"
                            date="{{ $insemination->date }}">2do Celo</button>
                    </td>

                    <td>{{ $birthDate->format('d-m-Y') }}</td>
                    <td>{{ $insemination->annotations ?? '-'}}</td>
                    <td>

                        <form action="inseminations/{{ $insemination->id }}" method="POST" id="deleteInseminationForm{{$insemination->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteInsemination" type="submit" form="deleteInseminationForm{{$insemination->id}}"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>

            @endif
        @endforeach
        
    </tbody>

</table>