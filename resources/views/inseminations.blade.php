@extends('adminlte::page')

@section('title', 'Don Nelso')

@section('content_header')
    <h1 class="m-0 text-dark">Inseminaciones</h1>
@stop

@section('content')

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsemination" id="btnNewInseminationMain">Nueva Inseminaci&oacute;n</button>
    <br>
    <br>

    @include('tables/inseminationsTable')

@stop

@include('modals/inseminations/newInsemination')

@section('js')

<script>

$(document).ready(function(){

    const getFemales = () => {

        let type = $('input[name="type"]:checked').val()
        console.log(type)
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: '{{ route("inseminaciones.hembras") }}',
            method: 'POST',
            data: {
                'type': type,
                '_token': token
            },
            beforeSend: function () {
                $('#loaderMothers').show();
            }
        }).done(resp => {

            $('#loaderMothers').hide();

            let options = []

            resp.forEach(female => {
                options.push({'id':`${female.id}`,'text':`${female.caravan}`})
            });
            

            $('#idMothers').html('')

            $('#idMothers').select2({
                multiple:true,
                placeholder:'',
                closeOnSelect: false,
                width: '100%',
                data:options
            }) 
            console.log('jol')
        }).fail((jqXHR, textStatus, errorThrown) => {
            $('#loaderMothers').hide();
        });

    };

    $('#btnNewInseminationMain').on('click',getFemales)

    $('input[name="type"]').on('change',getFemales)

})

</script>

@endsection

@section('css')

    <style>
     
    </style>
@endsection
