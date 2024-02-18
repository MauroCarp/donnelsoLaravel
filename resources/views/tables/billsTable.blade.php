<table class="table table-bordered table-striped dt-responsive serviceTable" width="100%">
         
    <thead>
     
        <tr>
                
            <th>Fecha</th>
            <th>Tipo de Gasto</th>
            <th>Descripci&oacute;n</th>
            <th>Monto</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($bills as $bill)

            @if($bill->type == $type)    

                <tr>
                    <td>{{ date('d-m-Y',strtotime($bill->date)) }}</td>
                    <td>{{ ucfirst($bill->billType) }}</td>
                    <td>{{ $bill->description }}</td>
                    <td> $ {{ number_format($bill->amount,2,',','.') }}</td>
                    <td>

                        <form action="bills/{{ $bill->id }}" method="POST" id="deletebillForm{{$bill->id}}">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeletebill" type="submit" form="deletebillForm{{$bill->id}}"><i class="fa fa-trash"></i></button>

                        </form>

                    </td>
                </tr>

            @endif

        @endforeach
        
    </tbody>

</table>