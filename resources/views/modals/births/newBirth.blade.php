@extends('modals/modal',['idModal' => 'modalBirth','modalTitle'=>'Nuevo Parto','modalSize'=>'md'])

@section('modalContent')

<form action="births" method="POST" id="newBirthForm" style="margin-bottom:0">
    @csrf        

    <div class='row'>
        
        <div class="col-lg-12">
        
                <label for="type">Animal:</label><br>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="cerdo" checked/>
                    <i class="icon icon-cerdo"></i>
                </label>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="chivo"/>
                    <i class="icon icon-chivo"></i>
                </label>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="ovino"/>
                    <i class="icon icon-cordero"></i>
                </label>

                <label style="font-size:1.6em;">
                    <input type="radio" name="type" class="d-none" value="vaca"/>
                    <i class="icon icon-vaca"></i>
                </label>

        </div>

    </div> 

    <div class="row">

        <div class="col-xs-12 col-lg-6">

            <div class="form-group">
            
                <label for="idMother">Caravana: <i class="fa fa-sync-alt rotating d-none" id="loaderMothers"></i></label><br>
            
                <select name="idMother" id="idMothers" required>

                </select>
            
            </div>
            
        </div>
     
        <div class="col-xs12 col-lg-6">

            <div class="form-group">
            
                <label for="date">Fecha Parto:</label>
                
                <input type="date" name="date" id="date" class="form-control" required> 
                
            </div>
            
        </div>
    
    </div>

    <div class="row">

        <div class="col-xs-12 col-lg-6">
            
            <div class="row">

                <div class="col-12">

                    <div class="form-group">
                                
                        <label for="amount">Cantidad:</label><br>

                        <input type="number" class="form-control" name="amount" id="amount" value="0">
                    
                    </div>

                </div>

                <div class="col-12">

                    <div class="form-group" style="display:flex">

                        <label for="sexRadio">Sexo:</label> 
                        
                        <div id="sexRadio" style="margin-left:10px">

                            <label for="m">M</label>

                            <input type="radio" name="sex" value="m" id="m" style="height: 20px; width: 20px;"  checked="checked">  

                            <label for="f">&nbsp;&nbsp;H</label>

                            <input type="radio" name="sex" value="f" id="f" style="height: 20px; width: 20px;"> 

                            <label for="mf">&nbsp;&nbsp;M/H</label>

                            <input type="radio" name="sex" value="mf" id="mf" style="height: 20px; width: 20px;">

                        </div>

                    </div>

                </div>

                <div class="col-12">

                    <div class="form-group" style="display:flex">
                                
                        <label for="twins" style="line-height:2.2em">Mellizos:</label>

                        <input type="checkbox" class="form-control" name="twins" id="twins" style="width:20px;margin-left:10px;">
                    
                    </div>

                </div>

            </div>
            
        </div>

        <div class="col-xs-12 col-lg-6">
            
            <div class="row">

                <div class="col-12">

                    <div class="form-group">
                    
                        <label for="complications">Complicaciones:</label><br>
        
                        <textarea cols="30" rows="1" class="form-control" name="complications" id="complications"></textarea>
                    
                    </div>

                </div>

                <div class="col-12">

                    <div class="form-group">
                    
                        <label for="deaths">Muertes:</label><br>
        
                        <input type="number" class="form-control" name="deaths" id="deaths" value="0"/>
                    
                    </div>

                </div>

            </div>

        </div>
    
    </div>

</form>

@endsection


@section('modalFooter')

    <button class="btn btn-primary btn-block" type="submit" form="newBirthForm" id="btnNewBirth" name="btnNewBirth">Cargar Servicio</button>

@endsection