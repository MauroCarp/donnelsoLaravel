@extends('adminlte::page')

@section('title', 'Don Nelso - Ventas')

@section('content_header')
    <h1 class="m-0 text-dark">Venta de Animales</h1>
@stop

@section('content')

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPreSale" id="btnNewPreSale">Nueva Pre-Venta</button>
<br>
<br>
<table class="table table-bordered table-striped dt-responsive saleTable" width="100%">
         
    <thead>
     
        <tr>

            <th>Cliente</th>
            <th>Fecha Entrega</th>
            <th>Animal</th>
            <th>Cantidades</th>
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($sales as $sale)

            <tr>
                <td>{{ $sale->client }}</td>
                <td>{{ date('d-m-Y',strtotime($sale->deliveryDate)) }}</td>
                <td>{{ ucfirst($sale->type) }}</td>
                <td><button type="button" class="btn btn-primary btnDetails" idSale="{{ $sale->id }}" animalType="{{ $sale->type }}"><i class="fa fa-list-alt"></i> Detalles</button></td>
                <td>

                    @if($sale->preSale)
                    <div class="btn-group">

                        <button class="btn btn-success btnFinalizeSale" idSale="{{ $sale->id }}"><i class="fa fa-arrow-circle-right"></i> Completar Venta</button>
                        
                        <form style="margin: 0; padding: 0; border: none;" action="sales/{{ $sale->id }}" method="POST">

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btnDeleteSale" style="height:100%;border-bottom-left-radius:0px;border-top-left-radius:0px;" type="submit"><i class="fa fa-trash"></i></button>

                        </form>

                    </div>

                    @endif

                </td>
            </tr>

        @endforeach
        
    </tbody>

</table>

@stop

@include('modals/sales/details')
@include('modals/sales/finalizeSale')

@section('js')

    <script>

        const getDetails = (idSale,finalize = '')=>{

            let token = $('input[name="_token"]').val()

            $.ajax({
                method:'POST',
                url:'sales/getDetails',
                data:{
                    '_token':token,
                    'id':idSale
                },
                beforeSend:function(){
                    $('.inputsDetails').each(function(){$(this).hide()})
                }
                
            }).done(function(resp){

                $(`#amountEntire${finalize}`).html(resp.amountEntire)
                $(`#kgEntire${finalize}`).html(resp.kgEntire)

                $(`#amountHalf${finalize}`).html(resp.amountHalf)
                $(`#kgHalf${finalize}`).html(resp.kgHalf)

                $(`#amountRibs${finalize}`).html(resp.amountRibs)
                $(`#kgRibs${finalize}`).html(resp.kgRibs)

                $(`#amountShoulder${finalize}`).html(resp.amountShoulder)
                $(`#kgShoulder${finalize}`).html(resp.kgShoulder)

                $(`#amountRearQuarter${finalize}`).html(resp.amountRearQuarter)
                $(`#kgRearQuarter${finalize}`).html(resp.kgRearQuarter)

                $(`#amountHead${finalize}`).html(resp.amountHead)
                $(`#kgHead${finalize}`).html(resp.kgHead)


                if(resp.amountEntire > 0){
                    $(`#inputEntire${finalize}`).show()

                    if(resp.kgEntire > 0) 
                        $(`#costEntire${finalize}`).html(resp.costs.entire)
                    else
                        $(`#costEntire${finalize}`).html('-')

                } else {
                    $(`#inputEntire${finalize}`).hide() 
                }

                if(resp.amountHalf > 0){
                    $(`#inputHalf${finalize}`).show()

                    if(resp.kgHalf > 0) 
                        $(`#costHalf${finalize}`).html(resp.costs.half)
                    else
                        $(`#costHalf${finalize}`).html('-')

                } else {
                    $(`#inputHalf${finalize}`).hide() 
                }


                if(resp.amountRibs > 0){
                    $(`#inputRibs${finalize}`).show()

                    if(resp.kgRibs > 0) 
                        $(`#costRibs${finalize}`).html(resp.costs.ribs)
                    else
                        $(`#costRibs${finalize}`).html('-')

                } else {
                    $(`#inputRibs${finalize}`).hide() 
                }
                
                if(resp.amountShoulder > 0){
                    $(`#inputShoulder${finalize}`).show()

                    if(resp.kgShoulder > 0) 
                        $(`#costShoulder${finalize}`).html(resp.costs.shoulder)
                    else
                        $(`#costShoulder${finalize}`).html('-')

                } else {
                    $(`#inputShoulder${finalize}`).hide() 
                }

                if(resp.amountRearQuarter > 0){
                    $(`#inputRearQuarter${finalize}`).show()

                    if(resp.kgRearQuarter > 0) 
                        $(`#costRearQuarter${finalize}`).html(resp.costs.rearQuarter)
                    else
                        $(`#costRearQuarter${finalize}`).html('-')

                } else {
                    $(`#inputRearQuarter${finalize}`).hide() 
                }

                if(resp.amountHead > 0){
                    $(`#inputHead${finalize}`).show()

                    if(resp.kgHead > 0) 
                        $(`#costHead${finalize}`).html(resp.costs.head)
                    else
                        $(`#costHead${finalize}`).html('-')

                } else {
                    $(`#inputHead${finalize}`).hide() 
                }


                if(finalize != ''){

                    $('#finalizeSaleForm .icon').each(function(){
                        $(this).hide()
                    })

                    $('input[name="idSale"]').val(resp.id)

                    switch (resp.type) {
                        case 'cerdo':
                            $('#finalizeSaleForm .icon-cerdo').show()
                            break;
                        case 'ovino':
                            $('#finalizeSaleForm .icon-cordero').show()
                            break;
                        case 'chivo':
                            $('#finalizeSaleForm .icon-chivo').show()
                            break;
                        case 'vaca':
                            $('#finalizeSaleForm .icon-vaca').show()
                            break;
                        case 'pollo':
                            $('#finalizeSaleForm .icon-pollo').show()
                            break;
                    
                        default:
                            break;
                    }
                }

            })

        }

        $('.saleTable').on('click','.btnDeleteSale',function(e){

            e.preventDefault()

            Swal.fire({
            title: "Estas seguro?",
            text: "Si no lo estas, puedes cancelar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "Cancelar"

            }).then((result) => {

                if (result.isConfirmed) {
                    
                    e.currentTarget.form.submit()

                }

            });

        })  
        
        $('.saleTable').on('click','.btnDetails',function(){

            let idSale = $(this).attr('idSale')

            let type = $(this).attr('animalType')

            let button = $(this)

            if(type == 'Cordero'){
                type = 'ovino'
            }else if(type == 'Lechón'){
                type = 'cerdo'
            }

            let token = $('input[name="_token"]').val()

            getDetails(idSale)
            
            $('#modalDetails').modal('show')

        })

        $('.saleTable').on('click','.btnFinalizeSale',function(){

            let idSale = $(this).attr('idSale')
            
            getDetails(idSale,'Finalize')
            
            $('#modalFinalize').modal('show')


        })
        
        

    </script>

@endsection

@if(session('created') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','success','Pre-Venta Cargada')

        })
        

    </script>

@endif

@if(session('finalize') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','success','Venta Completada')

        })
        

    </script>

@endif

@if(session('delete') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','error','Pre-Venta eliminada')

        })
        

    </script>

@endif