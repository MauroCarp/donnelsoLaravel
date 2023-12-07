@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Nacimientos</h1>
@stop

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBirth" id="btnNewBirthMain">Nueva Parto</button>
    <br>
    <br>

    @include('tables/births')

@stop

@include('modals/births/newBirth')

@section('js')

<script>

</script>

@endsection

@section('css')

    <style>

    </style>
@endsection
