@extends('adminlte::page')

@section('title', 'Don Nelso - ' . $title)

@section('content_header')
    <h1 class="m-0 text-dark">{{ $title }}</h1>
@stop

@section('content')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal{{ ucfirst($section) }}" id="btnNew{{ ucfirst($section) }}Main">{{ $btnText }}</button>
    <br>
    <br>

    <div class="row">

        <div class="col-lg-12">
    
            <div class="card card-default card-tabs">
    
                <div class="card-header p-0 pt-1">
    
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
    
                        <li class="nav-item active">
    
                            <a class="nav-link active" id="cerdo-tab" data-toggle="pill" href="#tabs-cerdo" role="tab" aria-controls="tabs-cerdo" aria-selected="false">Cerdos</a>
    
                        </li>
    
                        <li class="nav-item">
    
                            <a class="nav-link" id="chivo-tab" data-toggle="pill" href="#tabs-chivo" role="tab" aria-controls="tabs-chivo" aria-selected="false">Chivos</a>
    
                        </li>
    
                        <li class="nav-item">
    
                            <a class="nav-link" id="ovino-tab" data-toggle="pill" href="#tabs-ovino" role="tab" aria-controls="tabs-ovino" aria-selected="false">Ovinos</a>
    
                        </li>
    
                        <li class="nav-item">
    
                            <a class="nav-link" id="vaca-tab" data-toggle="pill" href="#tabs-vaca" role="tab" aria-controls="tabs-vaca" aria-selected="false">Vacas</a>
    
                        </li>
    
                    </ul>
    
                </div>
    
                <div class="card-body">
    
                    <div class="tab-content" id="services-tabs-tabContent">
                        
                        <div class="tab-pane fade active show" id="tabs-cerdo" role="tabpanel" aria-labelledby="tabs-cerdo-tab">
    
                            @php
                                $type = 'cerdo';   
                            @endphp
    
                            @include('tables/' . $section . 'sTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-ovino" role="tabpanel" aria-labelledby="tabs-ovino-tab">
    
                            @php
                                $type = 'ovino';   
                            @endphp
    
                            @include('tables/' . $section . 'sTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-chivo" role="tabpanel" aria-labelledby="tabs-chivo-tab">
    
                            @php
                                $type = 'chivo';   
                            @endphp
    
                            @include('tables/' . $section . 'sTable')
    
                        </div>
    
                        <div class="tab-pane fade" id="tabs-vaca" role="tabpanel" aria-labelledby="tabs-vaca-tab">
    
                            @php
                                $type = 'vaca';   
                            @endphp
    
                            @include('tables/' . $section . 'sTable')
    
                        </div>
    
                    </div>
    
                </div>
                
            </div>
    
        </div>
    
    </div>


@stop

@include('modals/' . $section . 's/new' . ucfirst($section))
