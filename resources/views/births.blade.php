@extends('base',['title'=>'Nacimientos','section'=>'birth','btnText'=>'Nuevo Parto','textCreated'=>'Nacimiento Cargado'])

@section('js')

<script>

    $('#btnNewBirthMain').on('click',getFemales)

    $('input[name="type"]').on('change',getFemales)

    $('input[name="sex"]').on('change',function(){

        if($(this).val() == 'mf'){

            $('#mfInput').show()

        } else {

            $('#mfInput').hide()

        }

    })

    $('#deaths').on('change',function(){

        if($(this).val() > 0){

            $('#mfDeadInput').show()
            $('#mfDeadMotiveInput').show()

        } else {

            $('#mfDeadInput').hide()
            $('#mfDeadMotiveInput').hide()

        }

    })

    $('#deadMotive').select2({
        'width':'100%'
    })

    $('#deadMotive').on('change',function(){

        if($(this).val() == 'other'){

            $('#otherInput').removeClass('d-none')

        } else {

            $('#otherInput').addClass('d-none')

        }
        
    })

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

    $('.reproductiveCaravans').each(function(){

        $(this).select2()

    })

    $('.birthTable').on('click','.btnUpdateMaleCaravan',function(){

        let idSelect = $(this).attr('idSelect')

        let selectValue = $(`#${idSelect}`).val()

        let selectOptText = $(`#${idSelect} option[value="${selectValue}"]`).text();

        let cell = $(`#${idSelect}`).parent().parent()

        let idBirth = idSelect.replace('maleCaravan','')

        $.ajax({
            method:'POST',
            url:`https://donnelso.com.ar/births/updateBirth`,
            data:{
                'idMale': selectValue,
                'idBirth': idBirth,
                '_token': $('input[name="_token"]').val(),
            },
            beforeSend:function(){

                $(`#${idSelect}`).parent().remove() 

                cell.html(`<i class="fa rotating fa-sync-alt"></i>`)

            },
        }).done(resp=>{

            cell.html(selectOptText)

            if(resp == 'ok'){

                Swal.fire({
                    toast:true,
                    icon:'success',
                    title: 'Macho asignado',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                })

            }

        })
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
