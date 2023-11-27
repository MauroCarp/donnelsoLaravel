@extends('modals/modal',['idModal' => 'modalCalendar','modalTitle'=>'Evento','modalSize'=>'md'])

@section('modalContent')

<button class="btn btn-primary mb-2" id="btnNewEvent">Nuevo evento</button>

<div class="info-box mb-3 bg-info">

    <div class="info-box-content">

        <div class="row">

            <div class="col-lg-10">
                <span class="info-box-text">Evento 1</span>
            </div>
            
            <div class="col-lg-2" style="text-align: right">

                <button class="btn btn-danger btn-md">
                    <i class="fa fa-times"></i>
                </button>
                
            </div>

        </div>

    </div>

</div>

<div class="info-box mb-3 bg-info">

    <div class="info-box-content">

        <div class="row">

            <div class="col-lg-10">
                <span class="info-box-text">Evento 1</span>
            </div>
            
            <div class="col-lg-2" style="text-align: right">

                <button class="btn btn-danger btn-md">
                    <i class="fa fa-times"></i>
                </button>
                
            </div>

        </div>

    </div>

</div>

<div class="info-box mb-3 bg-info">

    <div class="info-box-content">

        <div class="row">

            <div class="col-lg-10">
                <span class="info-box-text">Evento 1</span>
            </div>
            
            <div class="col-lg-2" style="text-align: right">

                <button class="btn btn-danger btn-md">
                    <i class="fa fa-times"></i>
                </button>
                
            </div>

        </div>

    </div>

</div>


@endsection
