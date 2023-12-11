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
            
            $('.nav-link').removeClass('active') 
            $(`#${typeAnimal}-tab`).addClass('active')

            $('.tab-pane').removeClass('active') 
            $(`#tabs-${typeAnimal}`).addClass('active')
            $(`#tabs-${typeAnimal}`).addClass('show')

        }

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
                "ordering":"false",

            }

        });


    </script>

    @yield('js')
@stop
