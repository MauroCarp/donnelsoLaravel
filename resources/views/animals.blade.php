@extends('adminlte::page')

@section('title', 'Don Nelso - Animales')

@section('content_header')
    <h1 class="m-0 text-dark">Animales</h1>
    <small>*Hacer doble click en los campos Caravana - Destino - Edad - Peso para poder modificarlos</small>
@stop

@section('content')

@role('admin')

    <div class="row">
        <div class="col-lg-4">
            <form action="animals/import" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input
                        type="file"
                        class="form-control"
                        name="animalsFile"
                    />
                </div>
                <div class="d-grid gap-2">
                    <button
                        type="submit"
                        name="submitAnimalsFile"
                        class="btn btn-primary"
                    >
                        Importar
                    </button>
                </div>
                
            </form>
        </div>
    </div>
    
@endrole

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
@include('modals/animals/healthHistorial')

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
                    url:`https://donnelso.com.ar/animals/${id}`,
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
                    console.log(resp)

                    if(selectValid){
                        $(`#${field.toLowerCase()}Text${id}`).html(text)
                        $(`#${field.toLowerCase()}${id}`).hide()
                    } else {

                        $(`#${field.toLowerCase()}${id}`).parent().hide()

                        if(resp == 'ok')
                            $(`#${field.toLowerCase()}Text${id}`).html(val)
                        
                        button.children().addClass('fa-edit')
                        button.children().removeClass('fa-sync-alt')
                        
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

                    }else{
                        Swal.fire({
                            toast:true,
                            icon:'error',
                            title: `${fieldText} ya existe para otro animal`,
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

        const generateBirthDetail = (data)=>{

            let lis = document.createDocumentFragment() 

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

            return lis
        }
   
        const generateHealthDetail = (data)=>{
                
            let lis = document.createDocumentFragment() 

            let liAplication = document.createElement('LI')
            liAplication.setAttribute('class','nav-item nav-link')
            liAplication.setAttribute('style','border-bottom:1px solid #dee2e6')

            let liComments = liAplication.cloneNode(true)
            let liMotive = liAplication.cloneNode(true)
            let liVetCost = liAplication.cloneNode(true)
            let liCaravan = liAplication.cloneNode(true)

            liAplication.innerText = 'Aplicación'
            liComments.innerText = 'Comentarios'
            liMotive.innerText = 'Motivo'
            liVetCost.innerText = 'Costo Veterinario'
            liCaravan.innerText = 'Caravana'

            let spanAplication = document.createElement('SPAN')
            spanAplication.setAttribute('class','float-right badge badge-success')
            let spanComments = spanAplication.cloneNode(true)
            let spanMotive = spanAplication.cloneNode(true)
            let spanVetCost = spanAplication.cloneNode(true)
            let spanCaravan = spanAplication.cloneNode(true)
            let spanComplications = spanAplication.cloneNode(true)
            let spanDeaths = spanAplication.cloneNode(true)

            spanAplication.innerText = data.aplication
            spanComments.innerText = data.comments || '-'
            spanMotive.innerText = data.motive
            spanVetCost.innerText = `$ ${Number(data.vetCost).toLocaleString('de-DE')}`           
            spanCaravan.innerText = data.animal.caravan || '-'

            liAplication.append(spanAplication)
            liComments.append(spanComments)
            liMotive.append(spanMotive)
            liVetCost.append(spanVetCost)
            liCaravan.append(spanCaravan)

            lis.append(liAplication)
            lis.append(liComments)
            lis.append(liMotive)
            lis.append(liVetCost)
            lis.append(liCaravan)

            return lis
        }

        const generatePurchaseDetail = (data)=>{

            let lis = document.createDocumentFragment() 

            let liAmount = document.createElement('LI')
            liAmount.setAttribute('class','nav-item nav-link')
            liAmount.setAttribute('style','border-bottom:1px solid #dee2e6')

            let liCost = liAmount.cloneNode(true)
            let liMale = liAmount.cloneNode(true)
            let liFemale = liAmount.cloneNode(true)
            let liDestination = liAmount.cloneNode(true)
            let liKg = liAmount.cloneNode(true)
            let liProvider = liAmount.cloneNode(true)

            liAmount.innerText = 'Cantidad'
            liMale.innerText = 'Machos'
            liFemale.innerText = 'Hembras'
            liDestination.innerText = 'Destino'
            liProvider.innerText = 'Proveedor'
            liCost.innerText = 'Costo'
            liKg.innerText = 'Kg'

            let spanAmount = document.createElement('SPAN')
            spanAmount.setAttribute('class','float-right badge badge-success')
            let spanCost = spanAmount.cloneNode(true)
            let spanMale = spanAmount.cloneNode(true)
            let spanFemale = spanAmount.cloneNode(true)
            let spanDestination = spanAmount.cloneNode(true)
            let spanKg = spanAmount.cloneNode(true)
            let spanProvider = spanAmount.cloneNode(true)

            spanAmount.innerText = data.amount
            spanCost.innerText = `$ ${data.cost.toLocaleString('de-DE')}`
            spanMale.innerText = data.males
            spanFemale.innerText = data.females

            let destination

            switch (data.destination) {
                case 'reproductive':
                    destination = 'REPRODUCTOR'
                    break;
            
                default:
                    destination = data.destination.toUpperCase()
                    break;
            }

            spanDestination.innerText = destination

            spanKg.innerText = `${data.kg} Kg`
            spanProvider.innerText = data.provider.name

            liAmount.append(spanAmount)
            liCost.append(spanCost)
            liMale.append(spanMale)
            liFemale.append(spanFemale)
            liDestination.append(spanDestination)
            liKg.append(spanKg)
            liProvider.append(spanProvider)

            lis.append(liAmount)
            lis.append(liCost)
            lis.append(liMale)
            lis.append(liFemale)
            lis.append(liDestination)
            lis.append(liKg)
            lis.append(liProvider)

            return lis
        }
        
        const generateDetail = (data,detail)=>{

            let title

            let lis

            if(detail == 'birth'){

                title = 'Nacimiento'

                lis = generateBirthDetail(data)

            }

            if(detail == 'health'){

                title = 'Sanidad'

                lis = generateHealthDetail(data)

            }

            if(detail == 'purchase'){
                title = 'Compra'

                lis = generatePurchaseDetail(data)

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
            divUserImage.setAttribute('style','margin-right:5px;')
            divCardFooter.setAttribute('class','card-footer p-0')

            let icon = document.createElement('I')
            let iconClass

            let type = (detail == 'birth') ? data.mother.type : data.type

            switch (type) {
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
            icon.setAttribute('style','font-size:3em;padding:15px;position:absolute')

            let h3 = document.createElement('H3')
            h3.setAttribute('class','widget-user-username')
            h3.setAttribute('style','margin-left:105px;')
            h3.innerText = title

            let h5 = document.createElement('H5')
            h5.setAttribute('class','widget-user-desc')
            h5.setAttribute('style','margin-left:105px;')

            h5.innerText = data.date

            divUserImage.append(icon)
            divUserHeader.append(divUserImage)
            divUserHeader.append(h3)
            divUserHeader.append(h5)

            if(detail == 'health' && data.others.length > 1){

                let historial = document.createElement('button')
                historial.setAttribute('class','btn btn-success float-right')
                historial.setAttribute('id','btnHealthHistorial')
                historial.setAttribute('data-toggle','modal')
                historial.setAttribute('data-target','#modalHealthHistorial')  

                let icon = document.createElement('i')
                icon.setAttribute('class','fa fa-list')

                historial.append(icon)

                divUserHeader.append(historial)

                let body = data.others.map(health=>{

                    let tr = document.createElement('TR')
                    let tdDate = document.createElement('TD')
                    let tdAplication = tdDate.cloneNode(true)
                    let tdMotive = tdDate.cloneNode(true)
                    let tdComments = tdDate.cloneNode(true)
                    let tdVetCost = tdDate.cloneNode(true)

                    let objectDate = moment(health.date, "YYYY-MM-DD HH:mm:ss").toDate();
                    let formatedDate = moment(objectDate).format('D-M-YYYY');

                    tdDate.innerText = formatedDate
                    tdAplication.innerText = health.aplication
                    tdMotive.innerText = health.motive
                    tdComments.innerText = health.comments
                    tdVetCost.innerText = Number(health.vetCost).toLocaleString('de-DE')
                    
                    tr.append(tdDate)
                    tr.append(tdAplication)
                    tr.append(tdMotive)
                    tr.append(tdComments)
                    tr.append(tdVetCost)

                    return tr

                })


                $('#healthHistorialTable').html('')
                $('#healthHistorialTable').append(body)

            }

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

            let urlDetail = (detail != 'health') ? `${detail}s` : detail

            $.ajax({
                method:'GET',
                url:`https://donnelso.com.ar/${urlDetail}/${idDetail}`,
                data:{
                    _token:token
                }
            }).done(resp=>{              
                generateDetail(resp,detail)
            })

        })

        $('#modalHealthHistorial').on('hidden.bs.modal', function () {
            $('#modalAnimal').modal('show')
        });

    </script>

@endsection