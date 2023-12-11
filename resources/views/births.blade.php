@extends('base',['title'=>'Nacimientos','section'=>'birth','btnText'=>'Nuevo Parto','textCreated'=>'Nacimiento Cargado'])

@section('js')

<script>

    $('#btnNewBirthMain').on('click',getFemales)

    $('input[name="type"]').on('change',getFemales)

    $('.birthTable').on('click','.btnDeleteBirth',function(e){

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

            fireSwal('{{session("type")}}','success','Nacimiento Cargado')

        })
        

    </script>

@endif

@if(session('delete') == 'ok')

    <script>

        document.addEventListener('DOMContentLoaded',function(){

            fireSwal('{{session("type")}}','error','Nacimiento eliminado')

        })
        

    </script>

@endif
