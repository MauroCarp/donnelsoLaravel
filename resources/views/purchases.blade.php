@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Compra de Animales</h1>
@stop

@section('content')

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPurchase" id="btnNewPurchase">Nueva Compra</button>
<br>
<br>
<table class="table table-bordered table-striped dt-responsive purchaseTable" width="100%">
         
    <thead>
     
        <tr>

            <th>Fecha de Compra</th>
            <th>Animal</th>
            <th>Proveedor</th>
            <th>Cantidad</th>
            <th>Machos</th>
            <th>Hembras</th>
            <th>Kg Total</th>
            <th>$ Total</th> 
            <th></th> 

        </tr> 

    </thead>

    <tbody>

        @foreach ($purchases as $purchase)

            <tr>
                <td>{{ date('d-m-Y',strtotime($purchase->date))}}</td>
                <td>{{ ucfirst($purchase->type) }}</td>
                <td>{{ $purchase->provider->name }}</td>
                <td>{{ $purchase->amount }}</td>
                <td>{{ $purchase->males }}</td>
                <td>{{ $purchase->females }}</td>
                <td>{{ $purchase->kg }}</td>
                <td>{{ $purchase->cost }}</td>
                <td>

                    <form action="purchases/{{ $purchase->id }}" method="POST">

                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btnDeletePurchase" type="submit"><i class="fa fa-times"></i></button>

                    </form>

                </td>
            </tr>

        @endforeach
        
    </tbody>

</table>

@stop

@include('modals/purchases/newPurchase')

@section('js')

    <script>
        
        $(document).ready(function() {
    

            $('input[name="type"]').on('change',function(){

                if ($(this).val() == 'pollo'){

                    $('#amountMaleFemale').hide()
                    $('#amount').show()
                    
                } else {

                    $('#amountMaleFemale').show()
                    $('#amount').hide()

                }


            })

            $('#idProvider').select2({
                placeholder: 'Seleccionar Proveedor',
                dropdownAutoWidth:true,
                dropdownParent: $('#modalPurchase .modal-body'),
            })

            $('#idProvider').on('change',function(){

                if ($(this).val() == 'other')
                    $('#newProvider').show()
                else
                    $('#newProvider').hide()
                

            })

            $('.purchaseTable').on('click','.btnDeletePurchase',function(e){

                e.preventDefault()
                Swal.fire({
                title: "Estas seguro?",
                text: "Si no lo estas, puedes cancelar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar",
                }).then((result) => {

                    if (result.isConfirmed) {
                        
                        e.currentTarget.form.submit()

                    }

                });

            })

        })

    </script>

    @if(session('delete') == 'ok')

        <script>

            document.addEventListener('DOMContentLoaded',function(){

                Swal.fire({
                    toast:true,
                    icon:'error',
                    title: 'Compra eliminada',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                })

            })



        </script>

    @endif

@endsection

@section('css')

@endsection

@if(session('purchase') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){


            Swal.fire({
                toast:true,
                type: 'success',
                title: 'Compra cargada',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

        })

    </script>

@endif