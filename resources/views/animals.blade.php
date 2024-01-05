@extends('adminlte::page')

@section('title', 'Don Nelso - Animales')

@section('content_header')
    <h1 class="m-0 text-dark">Animales</h1>
    <small>*Hacer doble click en los campos Destino - Edad - Peso para poder modificarlos</small>
@stop

@section('content')

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
    
                            @include('tables/animalsTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-ovino" role="tabpanel" aria-labelledby="tabs-ovino-tab">
    
                            @php
                                $type = 'ovino';   
                            @endphp
    
                            @include('tables/animalsTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-chivo" role="tabpanel" aria-labelledby="tabs-chivo-tab">
    
                            @php
                                $type = 'chivo';   
                            @endphp
    
                            @include('tables/animalsTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">
    
                            @php
                                $type = 'vaca';   
                            @endphp
    
                            @include('tables/animalsTable')
    
                        </div>
    
                    </div>
    
                </div>
                
            </div>
    
        </div>
    
    </div>


@stop

@include('modals/animals/updateAnimal')

@section('js')

    <script>

        const allowEdit = (classInput,field) => {

            $('.animalTable').on('dblclick',`.${classInput}`,function(){
    
                $(this).hide()

                let id = $(this).attr(`${field}Text`)
                console.log(id)
                console.log(`#${field}${id}`)

                $(`#${field}${id}`).show()
    
            })

        }

        const editField = (field,event) => {

            $('.animalTable').on(event,`.select${field}`,function(){

                let val = $(this).val()

                let selectValid = false

                if($(this)[0].nodeName == 'SELECT')
                    selectValid = true

                let text

                if(selectValid){
                    text = $(this).find(':selected').text();
                }                

                let id = $(this).attr('id').replace(field.toLowerCase(),'')

                let token = $('input[name="_token"]').val();

                $.ajax({
                    method:'PATCH',
                    url:`animals/${id}`,
                    data:{
                        _token:token,
                        field:field.toLowerCase(),
                        value:val
                    }
                }).done(resp=>{

                    $(`#${field.toLowerCase()}${id}`).hide()

                    if(selectValid)
                        $(`#${field.toLowerCase()}Text${id}`).html(text)
                    else
                        $(`#${field.toLowerCase()}Text${id}`).html(val)

                    $(`#${field.toLowerCase()}Text${id}`).show()

                    let fieldText = field
                    switch (field) {
                        case 'Destination':
                            fieldText = 'Destino'
                            break;
                        case 'Age':
                            fieldText = 'Edad'
                            break;
                        case 'Weight':
                            fieldText = 'Peso'
                            break;
                    
                        default:
                            break;
                    }

                    if(resp == 'ok'){

                        Swal.fire({
                            toast:true,
                            icon:'success',
                            title: `${fieldText} modificado`,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                        })   

                    }
                    
                })

            })

        }

        allowEdit('caravanText','caravan')

        editField('Caravan','blur')

        allowEdit('destinationText','destination')

        editField('Destination','change')

        allowEdit('ageText','age')

        editField('Age','blur')

        allowEdit('weightText','weight')

        editField('Weight','blur')

    </script>

@endsection