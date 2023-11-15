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
                        <h5>Carga Alumnos</h5>
                        <input type="file" name="excelStudents" id="">
                        <button type="submit">CARGAR</button>
                    </form>
                    <form action="{{ route('students.uploadPagos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h5>Carga Pagos</h5>
                        <input type="file" name="excelStudents">
                        <button type="submit">CARGAR</button>
                    </form>
                    <hr>
                    <a class="btn btn-default" href="{{route('students.validateData')}}">Validar Datos</a>
                    @isset($dataToValidate)

                        @foreach ($dataToValidate as $item)
                            
                            @if($item['dni']['validate'])
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Value</label>
                                    <input type="text" class="form-control" value="{{$item['dni']['dni']}}" readonly>
                                </div>
                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DNI</label>
                                    <input type="number" class="form-control" id="dniStudent{{$loop->index}}">
                                </div>
                
                                <button type="button" class="modificarDni"  index='{{$loop->index}}' dni="{{ $item['dni']['dni'] }}">Modificar</button>
                                <hr>
                            @endif
                            
                            @if($item['phone']['validate'])
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text"  class="form-control" value="{{$item['phone']['phone']}}" readonly>
                                </div>
                
                                <div class="form-group">
                                    <label for="studentPhone">Studen Phone</label>
                                    <input type="number" class="form-control" id="studentPhone{{$loop->index}}">
                                </div>
                                <div class="form-group">
                                    <label for="fatherPhone">Father Phone</label>
                                    <input type="number" class="form-control" id="fatherPhone{{$loop->index}}">
                                </div>
                                <div class="form-group">
                                    <label for="motherPhone">Mother Phone</label>
                                    <input type="number" class="form-control" id="motherPhone{{$loop->index}}">
                                </div>
                                <div class="form-group">
                                    <label for="guardianPhone">Guardian Phone</label>
                                    <input type="number" class="form-control" id="guardianPhone{{$loop->index}}">
                                </div>
                
                                <button type="button" class="modificarPhones" index='{{$loop->index}}' dni='{{ $item['dni']['dni'] }}'>Modificar</button>
                            @endif
                
                        @endforeach
                
                    @endisset
                    <hr>
                    <hr>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
<script>
    const token = $('input[name="_token"]').val()

    $('.modificarDni').each(function(){

        let dniOriginal = $(this).attr('dni')
        let index = $(this).attr('index')
        let btn = $(this)

        $(this).on('click',()=>{
    
            let dni = $(`#dniStudent${index}`).val()

            $.ajax({
                method:'POST',
                url:"{{ route('students.update') }}",
                data:{
                    type:'dni',
                    dni,
                    dniOriginal,
                    _token:token
                }
            }).done((resp)=>{
                console.log(resp)
                    if(resp == 'ok'){
                        btn.remove()
                    }
            })
        })

    })

    $('.modificarPhones').each(function(){
        let btn = $(this)

        let dniOriginal = $(this).attr('dni')
        let index = $(this).attr('index')

        $(this).on('click',()=>{
             
            let studentPhone = $(`#studentPhone${index}`).val()
            let fatherPhone = $(`#fatherPhone${index}`).val()
            let motherPhone = $(`#motherPhone${index}`).val()
            let guardianPhone = $(`#guardianPhone${index}`).val()

            $.ajax({
                method:'POST',
                url:"{{ route('students.update') }}",
                data:{
                    type:'phone',
                    dniOriginal,
                    studentPhone,
                    fatherPhone,
                    motherPhone,
                    guardianPhone,
                    _token:token
                },
                success:function(response){
                    console.log(response)
                    if(response == 'ok'){
                        btn.remove()
                    }
                }
            })

        })

    })

</script>
@endsection