@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Servicios</h1>
@stop

@section('content')

<button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalService" id="btnNewServiceMain">Nuevo Servicio</button>

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

                </ul>

            </div>

            <div class="card-body">

                <div class="tab-content" id="services-tabs-tabContent">
                    
                    <div class="tab-pane fade active show" id="tabs-cerdo" role="tabpanel" aria-labelledby="tabs-cerdo-tab">

                        @php
                            $type = 'cerdo';   
                        @endphp

                        @include('tables/servicesTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-ovino" role="tabpanel" aria-labelledby="tabs-ovino-tab">

                        @php
                            $type = 'ovino';   
                        @endphp

                        @include('tables/servicesTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-chivo" role="tabpanel" aria-labelledby="tabs-chivo-tab">

                        @php
                            $type = 'chivo';   
                        @endphp

                        @include('tables/servicesTable')

                    </div>

                    <div class="tab-pane fade" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">

                        @php
                            $type = 'vaca';   
                        @endphp

                        @include('tables/servicesTable')

                    </div>

                </div>

            </div>
            
        </div>

    </div>

</div> 

@stop

@include('modals/services/newService')

@section('js')

<script>

    const getReproductiveMales = () => {

        let type = $('input[name="type"]:checked').val()

        let token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{ route("servicios.machosReproductores") }}',
            method: 'POST',
            data: {
                'type': type,
                '_token': token
            },
            beforeSend: function () {
                $('#loaderMales').show();
            }
        }).done(resp => {

            $('#loaderMales').hide();

            let options = []

            resp.forEach(male => {
                options.push({'id':`${male.id}`,'text':`${male.caravan}`})
            });
            
            $('#idMales').html('')

            $('#idMales').select2({
                multiple:true,
                placeholder:'',
                closeOnSelect: false,
                width: '100%',
                data:options
            }) 

        }).fail((jqXHR, textStatus, errorThrown) => {
            $('#loaderMales').hide();
        });

    };


    $(document).ready(function(){

        $('#btnNewServiceMain').on('click',getReproductiveMales)
      
        $('input[name="type"]').on('change',getReproductiveMales)

        $('.serviceTable').on('click','.btnStateService',function(){

            let id = $(this).attr('idService')

            let token = $('input[name="_token"]').val();

            let button = $(this)

            $.ajax({
                method:'POST',
                url:`services/changeState`,
                data:{
                    'id':id,
                    '_token':token,
                }
            }).done(resp=>{

                Swal.fire({
                    toast:true,
                    icon:'success',
                    title: 'Estado cambiado con exito',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                })
    
                if(resp){
                    button.html('Activo')
                    button.removeClass('bg-danger')
                    button.addClass('bg-success')
                } else {
                    button.html('Inactivo')
                    button.removeClass('bg-success')
                    button.addClass('bg-danger')
                }

            })
        })

        $('.serviceTable').on('click','.btnDeleteService',function(e){

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

            let type = '{{ session("type") }}' 
            
            $('.nav-link').removeClass('active') 
            $(`#${type}-tab`).addClass('active')

            $('.tab-pane').removeClass('active') 
            $(`#tabs-${type}`).addClass('active')
            $(`#tabs-${type}`).addClass('show')

        })



    </script>

@endif

@endsection

@section('css')

    <style>

    </style>

@endsection
