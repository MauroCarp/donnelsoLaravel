@extends('base',['title'=>'Muertes','section'=>'death','btnText'=>'Nueva Muerte','textCreated'=>'Muerte Cargada'])

@section('js')

    <script>

        $('#motive').select2({
            placeholder:'Seleccionar Motivo'
        });


        $('#btnNewDeathMain').on('click',getAnimals)

        $('input[name="type"]').on('change',getAnimals)

        if($('#motive').val() == 'other')
            $('#otherInput').removeClass('d-none')

        $('#motive').on('change',function(){

            if($(this).val() == 'other'){
                $('#otherInput').removeClass('d-none')

            } else {
                $('#otherInput').addClass('d-none')

            }

        })

        $('.deadTable').on('click','.btnDeleteDead',function(e){

            e.preventDefault()

            Swal.fire({
            title: "Estas seguro?",
            text: "Si no lo estas, puedes cancelar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "Cancelar"

            }).then((result) => {

                if (result.isConfirmed) {
                    
                    e.currentTarget.form.submit()

                }

            });

        }) 

    </script>

@endsection

@if(session('created') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','success','Muerte cargada')

        })

    </script>

@endif

@if(session('delete') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','error','Muerte eliminada')
            
        })

    </script>

@endif