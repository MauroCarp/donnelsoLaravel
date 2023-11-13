@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('students.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="excelStudents" id="">
                        <button type="submit">CARGAR</button>
                    </form>

                    <a class="btn btn-default" href="{{route('students.validateData')}}">Validar Datos</a>
                </div>
            </div>
        </div>
    </div>
@stop
