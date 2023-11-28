@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content')

    <div class="row">

        <div class="col-lg-8 col-sm-12 col-md-12">

            <button type="button" class="btn btn-primary mt-2 ml-3" data-toggle="modal" data-target="#modalEvent" id="btnNewEventIndex">Agregar Nuevo Evento</button>

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
                                                <span class="info-box-text">${event.title}</span>
                                            </div>
                                            
                                            <div class="col-lg-2" style="text-align: right">
            
                                                <button class="btn btn-danger btn-md btnDeleteEvent" idEvent='${event.id}'>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                
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


    </script>

@endsection



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