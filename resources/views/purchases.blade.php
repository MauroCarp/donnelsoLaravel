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

            $('.btnDeletePurchase').on('click','.purchaseTable',function(e){
                e.preventDefault()
                
                console.log('mostrarSwal');
            })

        })



    </script>

@endsection

@section('css')

    <style>
        .select2-container .select2-selection--single {
            box-sizing: content-box;
        }
        input[type="radio"] + .icon,
        input[type="radio"] + label > .icon { cursor: pointer; font-size:2.5em;}

        /* Unchecked */
        input[type="radio"] + .icon-cerdo:before,
        input[type="radio"] + label > .icon-cerdo:before { content: "\e903";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-chivo:before,
        input[type="radio"] + label > .icon-chivo:before { content: "\e904";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-cordero:before,
        input[type="radio"] + label > .icon-cordero:before { content: "\e905";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-pollo:before,
        input[type="radio"] + label > .icon-pollo:before { content: "\e908";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-vaca:before,
        input[type="radio"] + label > .icon-vaca:before { content: "\e90a";color:black; border-right-color: black;} 

        /* CHECKED */
        input[type="radio"]:checked + .icon-cerdo:before,
        input[type="radio"]:checked + label > .icon-cerdo:before { content: "\e903";color:green; }

        input[type="radio"]:checked + .icon-chivo:before,
        input[type="radio"]:checked + label > .icon-chivo:before { content: "\e904";color:green; }

        input[type="radio"]:checked + .icon-cordero:before,
        input[type="radio"]:checked + label > .icon-cordero:before { content: "\e905";color:green; }

        input[type="radio"]:checked + .icon-pollo:before,
        input[type="radio"]:checked + label > .icon-pollo:before { content: "\e908";color:green; }

        input[type="radio"]:checked + .icon-vaca:before,
        input[type="radio"]:checked + label > .icon-vaca:before { content: "\e90a";color:green; }

    </style>

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