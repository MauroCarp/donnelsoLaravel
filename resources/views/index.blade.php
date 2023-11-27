@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content')
<div class="row">

    <div class="col-lg-8">
        <div id='calendar'></div>
    </div>

    <div class="col-lg-3">
        <h1>ALERTS</h1>
    </div>

</div>

@stop


@section('css')

@endsection

@section('js')

<script>
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale:'es',
        });

        calendar.render();
</script>
@endsection

