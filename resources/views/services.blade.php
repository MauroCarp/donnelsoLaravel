@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Servicios</h1>
@stop

@section('content')

<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalService" id="btnNewServiceMain">Nuevo Servicio</button>

<div class="row">

    <div class="col-lg-12">

        <div class="card card-default card-tabs">

            <div class="card-header p-0 pt-1">

                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item active">

                        <a class="nav-link active" id="cerdo-tab" data-toggle="pill" href="#tabs-cerdo" role="tab" aria-controls="tabs-cerdo" aria-selected="false">Cerdos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="ovino-tab" data-toggle="pill" href="#tabs-ovino" role="tab" aria-controls="tabs-ovino" aria-selected="false">Ovinos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="chivo-tab" data-toggle="pill" href="#tabs-chivo" role="tab" aria-controls="tabs-chivo" aria-selected="false">Chivos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="vaca-tab" data-toggle="pill" href="#tabs-vaca" role="tab" aria-controls="tabs-vaca" aria-selected="false">Vacas</a>

                    </li>

                </ul>

            </div>

            <div class="card-body">

                <div class="tab-content" id="services-tabs-tabContent">
                    
                    <div class="tab-pane fade" id="tabs-cerdo" role="tabpanel" aria-labelledby="tabs-cerdo-tab">
                    </div>

                    <div class="tab-pane fade" id="tabs-ovino" role="tabpanel" aria-labelledby="tabs-ovino-tab">
                    </div>

                    <div class="tab-pane fade" id="tabs-chivo" role="tabpanel" aria-labelledby="tabs-chivo-tab">
                    </div>

                    <div class="tab-pane fade active show" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">
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

    const getReproductiveMales = (type) => {

        return new Promise((resolve, reject) => {

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
                resolve(resp);
            }).fail((jqXHR, textStatus, errorThrown) => {
                $('#loaderMales').hide();
                reject(errorThrown);
            });

        });

    };

    $(document).ready(function(){

        $('#btnNewServiceMain').on('click',function(){
    
            console.log('hola')
            let type = $('input[name="type"]').val()
            getReproductiveMales(type)
            .then(data => {
    
                let options = []
    
                data.forEach(male => {
                    options.push({'id':`${male.id}`,'text':`${male.caravan}`})
                });
               
                $('#idMales').html('')
    
                console.log(options)
                $('#idMales').select2({
                    multiple:true,
                    placeholder:'',
                    closeOnSelect: false,
                    width: '100%',
                    data:options
                }) 
    
            })
            .catch(error => {
                // Manejar errores aquí
                console.error(error);
            });
    
        })
      
        $('input[name="type"]').on('change',function(){
    
            let type = $(this).val()
    
            getReproductiveMales(type)
            .then(data => {
    
                let options = []
    
                data.forEach(male => {
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
    
            })
            .catch(error => {
                // Manejar errores aquí
                console.error(error);
            });
    
        })
        
    })

</script>

@if(session('created') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){


            Swal.fire({
                toast:true,
                type: 'success',
                title: 'Servicio cargado',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            $('.nav-link').removeClass('active') 
            let type = '{{ session("type") }}' 

            $(`#${type}-tab`).addClass('active')

        })



    </script>

@endif

@endsection

@section('css')

    <style>

    </style>

@endsection
