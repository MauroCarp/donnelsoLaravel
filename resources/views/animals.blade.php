@extends('adminlte::page')

@section('title', 'Don Nelso - Animales')

@section('content_header')
    <h1 class="m-0 text-dark">Animales</h1>
    <small>*Hacer doble click en los campos Caravana - Destino - Edad - Peso para poder modificarlos</small>
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

@include('modals/animals/detail')

@section('js')

    <script>

        const allowEdit = (classInput,field) => {

            $('.animalTable').on('dblclick',`.${classInput}`,function(){
    
                $(this).hide()

                let id = $(this).attr(`${field}Text`)

                if(field != 'destination')
                    $(`#${field}${id}`).parent().show()
                else 
                    $(`#${field}${id}`).show()
    
            })

        }

        const editField = (field,event) => {

            let classField = (field == 'Destination') ? `select${field}` : `btnUpdate${field}`

            $('.animalTable').on(event,`.${classField}`,function(){


                let selectValid = false

                let button = $(this)
                
                let text
                
                let id
                
                let val

                if($(this)[0].nodeName == 'SELECT'){

                    selectValid = true
                    val = $(this).val()
                    id = $(this).attr('id').replace(field.toLowerCase(),'')

                } else {

                    id = $(this).attr('idAnimal')
                    val = $(`#${field.toLowerCase()}${id}`).val()
                     
                }

                if(selectValid){
                    text = $(this).find(':selected').text();
                }                


                let token = $('input[name="_token"]').val();

                $.ajax({
                    method:'PATCH',
                    url:`animals/${id}`,
                    data:{
                        _token:token,
                        field:field.toLowerCase(),
                        value:val
                    },

                    beforeSend:function(){

                        if(!selectValid){
                            button.children().removeClass('fa-edit')
                            button.children().addClass('fa-sync-alt')
                        }

                    }

                }).done(resp=>{

                    
                    if(selectValid){
                        $(`#${field.toLowerCase()}Text${id}`).html(text)
                        $(`#${field.toLowerCase()}${id}`).hide()
                    } else {
                        $(`#${field.toLowerCase()}${id}`).parent().hide()
                        $(`#${field.toLowerCase()}Text${id}`).html(val)
                    }

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
                        case 'Caravan':
                            fieldText = 'Caravana'
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

        editField('Caravan','click')

        allowEdit('destinationText','destination')

        editField('Destination','change')

        allowEdit('ageText','age')

        editField('Age','click')

        allowEdit('weightText','weight')

        editField('Weight','click')

        const generateDetail = (data,detail)=>{

            let title

            let lis = document.createDocumentFragment() 

            if(detail == 'birth'){

                title = 'Nacimiento'

                let liAmount = document.createElement('LI')
                liAmount.setAttribute('class','nav-item nav-link')
                liAmount.setAttribute('style','border-bottom:1px solid #dee2e6')

                let liSex = liAmount.cloneNode(true)
                let liMother = liAmount.cloneNode(true)
                let liFather = liAmount.cloneNode(true)
                let liTwins = liAmount.cloneNode(true)
                let liComplications = liAmount.cloneNode(true)
                let liDeaths = liAmount.cloneNode(true)

                liAmount.innerText = 'Cantidad'
                liSex.innerText = 'Sexo'
                liMother.innerText = 'Madre'
                liFather.innerText = 'Padre'
                liTwins.innerText = 'Mellizos'
                liComplications.innerText = 'Complicaciones'
                liDeaths.innerText = 'Muertes'

                let spanAmount = document.createElement('SPAN')
                spanAmount.setAttribute('class','float-right badge badge-success')
                let spanSex = spanAmount.cloneNode(true)
                let spanMother = spanAmount.cloneNode(true)
                let spanFather = spanAmount.cloneNode(true)
                let spanTwins = spanAmount.cloneNode(true)
                let spanComplications = spanAmount.cloneNode(true)
                let spanDeaths = spanAmount.cloneNode(true)

                spanAmount.innerText = data.amount
                spanSex.innerText = (data.sex == 'm') ? 'Macho' : ((data.sex == 'h') ? 'Hembra' : 'Macho/Hembra')
                spanMother.innerText = `Caravana ${data.mother.caravan}`
                spanFather.innerText = `Caravana ${data.father.caravan}`

                let i = document.createElement('I')
                i.setAttribute('class','fa fa-times')
                if(data.twins)
                    i.setAttribute('class','fa fa-check')

                spanTwins.append(i)

                spanComplications.innerText = (data.complications == null) ? '-' : data.complications
                spanDeaths.innerText = data.deaths

                liAmount.append(spanAmount)
                liSex.append(spanSex)
                liMother.append(spanMother)
                liFather.append(spanFather)
                liTwins.append(spanTwins)
                liComplications.append(spanComplications)
                liDeaths.append(spanDeaths)

                lis.append(liAmount)
                lis.append(liSex)
                lis.append(liMother)
                lis.append(liFather)
                lis.append(liTwins)
                lis.append(liComplications)
                lis.append(liDeaths)

            }

            if(detail == 'health'){
                title = 'Sanidad'

            }

            if(detail == 'purchase'){
                title = 'Compra'

            }


            let details = document.createDocumentFragment()

            let divRow = document.createElement('DIV')
            let divCol = divRow.cloneNode(true)
            let divCard = divRow.cloneNode(true)
            let divUserHeader = divRow.cloneNode(true)
            let divUserImage = divRow.cloneNode(true)
            let divCardFooter = divRow.cloneNode(true)

            divRow.setAttribute('class','row')
            divCol.setAttribute('class','col-lg-12')
            divCard.setAttribute('class','card card-widget widget-user-2 shadow-sm')
            divUserHeader.setAttribute('class','widget-user-header bg-info')
            divUserImage.setAttribute('class','widget-user-image')
            divCardFooter.setAttribute('class','card-footer p-0')

            let icon = document.createElement('I')
            let iconClass
            switch (data.mother.type) {
                case 'cerdo':
                    iconClass = 'icon-cerdo'
                    break;
                case 'ovino':
                    iconClass = 'icon-cordero'
                    break;
                case 'vaca':
                    iconClass = 'icon-vaca'
                    break;
                case 'chivo':
                    iconClass = 'icon-chivo'
                    break;
            
                default:
                    break;
            }
            icon.setAttribute('class',`${iconClass} img-circle elevation-2`)
            icon.setAttribute('style','font-size:3em;padding:5px;position:absolute')

            let h3 = document.createElement('H3')
            h3.setAttribute('class','widget-user-username')
            h3.innerText = title

            let h5 = document.createElement('H5')
            h5.setAttribute('class','widget-user-desc')
            h5.innerText = data.date

            divUserImage.append(icon)
            divUserHeader.append(divUserImage)
            divUserHeader.append(h3)
            divUserHeader.append(h5)

            divCard.append(divUserHeader)

            details.append(divCard)

            let ul = document.createElement('UL')
            ul.setAttribute('class','nav flex-column')

            ul.append(lis)

            details.append(ul)

            $('#detailConteiner').html(details)
        }

        $('.animalTable').on('click','.btnAnimalDetail',function(){

            let detail = $(this).attr('detail')

            let idDetail = $(this).attr('idDetail')

            let token = $('input[name="_token"]').val();

            $.ajax({
                method:'GET',
                url:`${detail}s/${idDetail}`,
                data:{
                    _token:token
                }
            }).done(resp=>{
                console.log(resp)
                generateDetail(resp,detail)
            })

        })


    </script>

@endsection