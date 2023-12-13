@extends('modals/modal',['idModal' => 'modalCalendar','modalTitle'=>'Lista de Eventos','modalSize'=>'md'])

@section('modalContent')

<button class="btn btn-success mb-2" id="btnNewEvent">Nuevo evento</button>

<div id="calendarEvents">
</div>


@endsection


@section('modalFooter')
@endsection