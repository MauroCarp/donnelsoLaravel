@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Inseminaciones</h1>
@stop

@section('content')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalInsemination" id="btnNewInseminationMain">Nueva Inseminaci&oacute;n</button>
    <br>
    <br>

    <div class="row">

        <div class="col-lg-12">
    
            <div class="card card-default card-tabs">
    
                <div class="card-header p-0 pt-1">
    
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
    
                        <li class="nav-item active">
    
                            <a class="nav-link active" id="cerdo-tab" data-toggle="pill" href="#tabs-cerdo" role="tab" aria-controls="tabs-cerdo" aria-selected="false">Cerdos</a>
    
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
    
                            @include('tables/inseminationsTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">
    
                            @php
                                $type = 'vaca';   
                            @endphp
    
                            @include('tables/inseminationsTable')
    
                        </div>
    
                    </div>
    
                </div>
                
            </div>
    
        </div>

    </div>

@stop

@include('modals/inseminations/newInsemination')
@include('modals/inseminations/secondHeat')

@section('js')

<script>

$(document).ready(function(){

    $('#btnNewInseminationMain').on('click',getFemales)

    $('input[name="type"]').on('change',getFemales)

    $('.inseminationsTable').on('click','.btnDeleteInsemination',function(event){
        event.preventDefault()

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
                    event.currentTarget.form.submit()

                }

            });

    })

    $('.inseminationsTable').on('click','.btnSecondHeat',function(){

        let caravans = $(this).attr('caravans').split('-')
        let type = $(this).attr('type')
        let inseminationId = $(this).attr('id')

        $('#idMothersToService').html('')

        caravans.forEach(element => {
            $('#idMothersToService').append($(`<option value="${element}">${element}</option>`))
        });

        let token = $('input[name="_token"]').val();

        $('#inseminationDate').val($(this).attr('date'))
        $('#inseminationType').val(type)
        $('#inseminationId').val(inseminationId)

        $.ajax({
            'method':'POST',
            'url':'services/reproductiveMales',
            'data':{
                'type':type,
                '_token':token
            }
        }).done(resp=>{

            $('#idReproductiveMales').html()
            console.log(resp)
            resp.forEach(reproductiveMale => {
                
                $('#idReproductiveMales').append($(`<option value="${reproductiveMale.id}">${reproductiveMale.caravan}</option>`))

            });

        })

    })


})

</script>

@endsection

@if(session('created') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            Swal.fire({
                toast:true,
                icon:'success',
                title: 'Inseminación cargada',
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
                title: 'Inseminación eliminada',
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

@section('css')

    <style>
     
    </style>

@endsection
