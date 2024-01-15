@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content')

    <div class="row">

        <div class="col-lg-8 col-sm-12 col-md-12">

            <button type="button" class="btn btn-success mt-2 ml-3" data-toggle="modal" data-target="#modalEvent" id="btnNewEventIndex">Agregar Nuevo Evento</button>

            <div id='calendarOverlay' class="overlay"></div>
            <div id='calendar'></div>

        </div>

    </div>

@stop

@include('modals/index/newEvent')

@include('modals/index/calendar')

@section('js')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            let form = document.getElementById('formNewEvent')

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',
                displayEventTime: false,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },

                locale:'es',
                events:'events',
                loading:function(isLoading){

                    if (isLoading) {
                        $('#calendarOverlay').show()
                    } else {
                        $('#calendarOverlay').hide(500)
                    }

                },
                dateClick:function(info){

                    $('#modalCalendar').modal('show')

                    form.reset()

                    form.start.value = info.dateStr
                    form.end.value = info.dateStr

                    const events = calendar.getEvents();   

                    $('#calendarEvents').html('')

                    events.forEach(event => {
                        
                        let eventDate = moment(event.start).format('YYYY-MM-DD')
                        let cellDate = moment(info.dateStr).format('YYYY-MM-DD');

                        if(eventDate == cellDate){

                            $('#calendarEvents').append($(`

                                <div class="info-box mb-3 bg-info">
                
                                    <div class="info-box-content">
            
                                        <div class="row">
            
                                            <div class="col-lg-10">
                                                <span class="info-box-text" style="white-space:normal">${event.title}</span>
                                            </div>
                                            
                                            <div class="col-lg-2" style="text-align: right">
                                                
                                                <form action="events/${event.id}ah peh" method="POST" id="deleteEventForm${event.id}">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-md" onclick="deleteEvent(event)" type="submit" form="deleteEventForm${event.id}"><i class="fa fa-trash"></i></button>

                                                </form>
                                                
                                            </div>
            
                                        </div>
            
                                    </div>
                                    
                                </div>

                            `))
                        }
                        
                    });

                },


            });
            
            calendar.render();

        })

        $('#btnNewEvent').on('click',function(){

            $('#modalCalendar').modal('hide')

            $('#modalEvent').modal('show')

        })

        $('#btnNewEventIndex').on('click',function(){

            document.getElementById('formNewEvent').reset()
        })

        $('#start').on('change',function(){

            let startDate = $(this).val()
            $('#end').val(startDate)
            
        })

        const deleteEvent = (event) => {

            event.preventDefault();

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
                    
                    let clickedElement = event.target;

                    if (clickedElement.tagName.toLowerCase() === 'i')
                        clickedElement = clickedElement.parentNode;

                    $(`#${clickedElement.attributes.form.value}`).submit()

                }

            });

        }
    </script>

@endsection


@if(session('delete') == 'ok')

    <script>
        document.addEventListener('DOMContentLoaded',function(){

            Swal.fire({
                toast:true,
                icon:'error',
                title: 'Evento eliminado',
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            })

        })

    </script>

@endif

@if(session('create') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            Swal.fire(
                'Evento Creado',
                'Ha sido guadado correctamente',
                'success'
            )

        })

    </script>

@endif


@section('css')

    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Color oscuro semitransparente */
            display: none; /* Inicialmente oculto */
            z-index: 1000; /* Asegura que esté por encima de otros elementos */
        }    
    </style>

@endsection