@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content')

    <div class="row">

        <div class="col-lg-8 col-sm-12 col-md-12">

            <button type="button" class="btn btn-primary mt-2 ml-3" data-toggle="modal" data-target="#modalEvent">Agregar Nuevo Evento</button>

            <div id='calendar'></div>

        </div>

    </div>

@stop

@include('modals/newEvent')

@include('modals/calendar')

@section('js')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                initialView: 'dayGridMonth',
                displayEventTime: false,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },

                locale:'es',

                dateClick:function(info){

                    $('#modalCalendar').modal('show')

                },

                events:'{{ route("eventos.mostrar") }}',

            });
            
            calendar.render();

        })

        $('#btnNewEvent').on('click',function(){

            $('#modalCalendar').modal('hide')

            $('#modalEvent').modal('show')

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