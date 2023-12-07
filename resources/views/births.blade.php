@extends('base',['title'=>'Nacimientos','section'=>'birth','btnText'=>'Nuevo Parto','textCreated'=>'Nacimiento Cargado'])

@section('js')

<script>

    $('#btnNewBirthMain').on('click',getFemales)

    $('input[name="type"]').on('change',getFemales)

</script>

@endsection
