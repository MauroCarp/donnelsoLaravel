@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')

    <style>
        input[type="radio"] + .icon,
        input[type="radio"] + label > .icon { cursor: pointer; font-size:2.5em;}

        /* Unchecked */
        input[type="radio"] + .icon-cerdo:before,
        input[type="radio"] + label > .icon-cerdo:before { content: "\e906";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-chivo:before,
        input[type="radio"] + label > .icon-chivo:before { content: "\e907";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-cordero:before,
        input[type="radio"] + label > .icon-cordero:before { content: "\e908";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-pollo:before,
        input[type="radio"] + label > .icon-pollo:before { content: "\e90b";color:black; border-right-color: black;} 

        input[type="radio"] + .icon-vaca:before,
        input[type="radio"] + label > .icon-vaca:before { content: "\e90d";color:black; border-right-color: black;} 

        /* CHECKED */
        input[type="radio"]:checked + .icon-cerdo:before,
        input[type="radio"]:checked + label > .icon-cerdo:before { content: "\e906";color:green; }

        input[type="radio"]:checked + .icon-chivo:before,
        input[type="radio"]:checked + label > .icon-chivo:before { content: "\e907";color:green; }

        input[type="radio"]:checked + .icon-cordero:before,
        input[type="radio"]:checked + label > .icon-cordero:before { content: "\e908";color:green; }

        input[type="radio"]:checked + .icon-pollo:before,
        input[type="radio"]:checked + label > .icon-pollo:before { content: "\e90b";color:green; }

        input[type="radio"]:checked + .icon-vaca:before,
        input[type="radio"]:checked + label > .icon-vaca:before { content: "\e90d";color:green; }


        .select2-container .select2-selection--single {
            box-sizing: content-box;
        }

        .rotating {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Preloader Animation --}}
        @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
    
@stop

@include('modals/sales/newPreSale')
@include('modals/costs/costs')
@include('modals/costs/costsHistorial')

@section('adminlte_js')
    @stack('js')
    
    <script>
        
        const getFemales = () => {
            
            let type = $('input[name="type"]:checked').val()
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("inseminaciones.hembras") }}',
                method: 'POST',
                data: {
                    'type': type,
                    '_token': token
                },
                beforeSend: function () {
                    $('#loaderMothers').show();
                }
            }).done(resp => {

                $('#loaderMothers').hide();

                let options = []

                resp.forEach(female => {
                    options.push({'id':`${female.id}`,'text':`${female.caravan}`})
                });
                

                $('#idMothers').html('')

                let urlParts = window.location.href.split('/')
                let section = urlParts[urlParts.length - 1]

                let config = {                    
                    placeholder:'',
                    width: '100%',
                    data:options
                }

                if(section != 'births'){
                    config.multiple = true
                    config.closeOnSelect = false
                }
                    
                $('#idMothers').select2(config) 

            }).fail((jqXHR, textStatus, errorThrown) => {
                $('#loaderMothers').hide();
            });

        };

        const getAnimals = () => {
            
            let type = $('input[name="type"]:checked').val()
            let token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{ route("getAnimals") }}',
                method: 'POST',
                data: {
                    'type': type,
                    '_token': token
                },
            }).done(resp => {

                let options = []
           
                resp.forEach(animal => {
                    options.push({'id':`${animal.id}`,'text':`${animal.caravan}`})
                });
                
                $('#caravans').html('')

                let config = {                    
                    placeholder:'',
                    width: '100%',
                    dropdownAutoWidth:true,
                    data:options
                }
                    
                $('#caravans').select2(config) 

            }).fail((jqXHR, textStatus, errorThrown) => {
                $('#loaderMothers').hide();
            });

        };
  
        const fireSwal = (typeAnimal,typeSwal,title)=>{

            Swal.fire({
                toast:true,
                icon:typeSwal,
                title: title,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            })
            
            if(typeAnimal != null)
            $('.nav-link').removeClass('active') 
            $(`#${typeAnimal}-tab`).addClass('active')

            $('.tab-pane').removeClass('active') 
            $(`#tabs-${typeAnimal}`).addClass('active')
            $(`#tabs-${typeAnimal}`).addClass('show')

        }

        const getCosts = (type) => {

            let token = $('input[name="_token"]').val();

            $.ajax({
                'method':'POST',
                'url':'costs/getCosts',
                'data':{
                    'type':type,
                    '_token':token
                },
                beforeSend:function(){
                    $('#loaderCost').show()
                }

            }).done(resp=>{

                $('#loaderCost').hide()

                $(`#costEntire${type}`).val(resp.actual.entire) 
                $(`#costHalf${type}`).val(resp.actual.half)
                $(`#costRibs${type}`).val(resp.actual.ribs)
                $(`#costRearQuarter${type}`).val(resp.actual.rearQuarter)
                $(`#costShoulder${type}`).val(resp.actual.shoulder)
                $(`#costHead${type}`).val(resp.actual.head)
                $(`#costMatadero${type}`).val(resp.actual.matadero)
                $(`#costAdmin${type}`).val(resp.actual.admin)
                $(`#costEmployer${type}`).val(resp.actual.employer)

            })

        }

        const showCostByType = ()=>{

            let type = $('input[name="typeCost"]:checked').val()

            $('.costInputs').each(function(){

                $(this).hide()

            })

            getCosts(type)

            switch (type) {

                case 'cerdo':
                    $('#costsCerdo').show()
                    break;
                case 'chivo':
                    $('#costsChivo').show()
                    break;
                case 'ovino':
                    $('#costsOvino').show()
                    break;
                case 'vaca':
                    $('#costsVaca').show()
                    break;
                case 'pollo':
                    $('#costsPollo').show()
                    break;

                default:
                    break;
            }
        }

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {

            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();

        });

        $(".table").DataTable({

            "language": {

                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
                },
            },
            "ordering":false,
            'responsive':true

        });

        $('#btnCostos').on('click',showCostByType)

        $('input[name="typeCost"]').on('change',showCostByType)

        $('.btnHistorial').each(function(){

            $(this).on('click',function(){

                $('#modalCosts').modal('hide')
                $('#modalCostsHistorial').modal('show')

            })

        })
        
    </script>

    @yield('js')

    @if(session('update') == 'ok')

        <script>

            document.addEventListener('DOMContentLoaded',function(){

                fireSwal(null,'success','Costo Actualizado')

            })
            

        </script>

    @endif

@stop
