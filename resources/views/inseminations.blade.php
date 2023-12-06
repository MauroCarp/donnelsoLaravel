@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Inseminaciones</h1>
@stop

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsemination" id="btnNewInsemination">Nueva Inseminaci&oacute;n</button>
    <br>
    <br>

    @include('tables/inseminationsTable')

@stop

@include('modals/inseminations/newInsemination')

@section('js')

<script>

</script>

@endsection

@section('css')

    <style>
     
    </style>
@endsection
