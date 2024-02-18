@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Gastos</h1>
@stop

@section('content')

<button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalBill" id="btnNewBillMain">Nuevo Gasto</button>

<div class="row">

    <div class="col-lg-12">

        <div class="card card-default card-tabs">

            <div class="card-header p-0 pt-1">

                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item active">

                        <a class="nav-link active" id="cerdo-tab" data-toggle="pill" href="#tabs-cerdo" role="tab" aria-controls="tabs-cerdo" aria-selected="false">Cerdos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="chivo-tab" data-toggle="pill" href="#tabs-chivo" role="tab" aria-controls="tabs-chivo" aria-selected="false">Chivos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="ovino-tab" data-toggle="pill" href="#tabs-ovino" role="tab" aria-controls="tabs-ovino" aria-selected="false">Ovinos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="vaca-tab" data-toggle="pill" href="#tabs-vaca" role="tab" aria-controls="tabs-vaca" aria-selected="false">Vacas</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="pollo-tab" data-toggle="pill" href="#tabs-pollo" role="tab" aria-controls="tabs-pollo" aria-selected="false">Pollos</a>

                    </li>

                </ul>

            </div>

            <div class="card-body">

                <div class="tab-content" id="bills-tabs-tabContent">
                    
                    <div class="tab-pane fade active show" id="tabs-cerdo" role="tabpanel" aria-labelledby="tabs-cerdo-tab">

                        @php
                            $type = 'cerdo';   
                        @endphp

                        @include('tables/billsTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-ovino" role="tabpanel" aria-labelledby="tabs-ovino-tab">

                        @php
                            $type = 'ovino';   
                        @endphp

                        @include('tables/billsTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-chivo" role="tabpanel" aria-labelledby="tabs-chivo-tab">

                        @php
                            $type = 'chivo';   
                        @endphp

                        @include('tables/billsTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">

                        @php
                            $type = 'vaca';   
                        @endphp

                        @include('tables/billsTable')

                    </div>
                    
                    <div class="tab-pane fade" id="tabs-pollo" role="tabpanel" aria-labelledby="tabs-pollo-tab">

                        @php
                            $type = 'pollo';   
                        @endphp

                        @include('tables/billsTable')

                    </div>

                </div>

            </div>
            
        </div>

    </div>

</div> 

@stop

@include('modals/bills/newBill')

@section('js')

<script>

    $(document).ready(function(){

        // $('#btnNewServiceMain').on('click',getReproductiveMales)
      
        // $('input[name="type"]').on('change',getReproductiveMales)

        // $('.serviceTable').on('click','.btnStateService',function(){

        //     let id = $(this).attr('idService')

        //     let token = $('input[name="_token"]').val();

        //     let button = $(this)

        //     $.ajax({
        //         method:'POST',
        //         url:`https://donnelso.com.ar/services/changeState`,
        //         data:{
        //             'id':id,
        //             '_token':token,
        //         }
        //     }).done(resp=>{

        //         Swal.fire({
        //             toast:true,
        //             icon:'success',
        //             title: 'Estado cambiado con exito',
        //             position: 'top-end',
        //             showConfirmButton: false,
        //             timer: 2000,
        //         })
    
        //         if(resp){
        //             button.html('Activo')
        //             button.removeClass('bg-danger')
        //             button.addClass('bg-success')
        //         } else {
        //             button.html('Inactivo')
        //             button.removeClass('bg-success')
        //             button.addClass('bg-danger')
        //         }

        //     })
        // })

        $('.billsTable').on('click','.btnDeleteBill',function(e){

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

        $('#billType').select2({
            'width':'100%'
        })

    })

</script>

@if(session('created') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){


            Swal.fire({
                toast:true,
                icon:'success',
                title: 'Servicio cargado',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            })

            let type = '{{ session("type") }}' 
            
            $('.nav-link').removeClass('active') 
            $(`#${type}-tab`).addClass('active')

            $('.tab-pane').removeClass('active') 
            $(`#tabs-${type}`).addClass('active')
            $(`#tabs-${type}`).addClass('show')

        })



    </script>

@endif

@if(session('delete') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            Swal.fire({
                toast:true,
                icon:'error',
                title: 'Servicio eliminado',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            })

        })



    </script>

@endif

@endsection

@section('css')

    <style>

    </style>

@endsection
