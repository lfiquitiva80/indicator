    @extends('layouts.app')

    @section('content')


<div class="container">


<!-- Button trigger modal -->
<br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Filtros
</button>
<center><h1 class="display-6"><strong>Seg. Costo M.O y Carga Prestacional</strong></h1></center>
<br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filtros</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                     <form action="" method="{{route('payroll.index')}}" role="form" class="form-inline" >
                    

    <div class="form-group">

        <legend>Mes</legend>

        <select name="Mes[]" id="input" class="form-select" aria-label="Default select example" multiple="multiple" required>

           
            <option value="01-Ene">01-Ene</option>
            <option value="02-Feb">02-Feb</option>
            <option value="03-Mar">03-Mar</option>
            <option value="04-Abr">04-Abr</option>
            <option value="05-May">05-May</option>
            <option value="06-Jun">06-Jun</option>
            <option value="07-Jul">07-Jul</option>
            <option value="08-Ago">08-Ago</option>
            <option value="09-Sep">09-Sep</option>
            <option value="10-Oct">10-Oct</option>
            <option value="11-Nov">11-Nov</option>
            <option value="12-Dic">12-Dic</option>

        </select>

    </div>


        <div class="form-group">

        <legend>Área</legend>
        
        <select name="area" id="input" class="form-select" aria-label="Default select example">

             <option value="PERSONAL CULTIVO">PERSONAL CULTIVO</option>
             <option value="SANIDAD - INFRAESTRUCTURA">SANIDAD - INFRAESTRUCTURA</option>
             <option value="FABRICA">FABRICA</option>
             <option value="GANADERIA">GANADERIA</option>
             <option value="ADMINISTRACION">ADMINISTRACION</option>
             <option value="TALLER">TALLER</option>
             <option value="PROYECTOS">PROYECTOS</option>
             <option value="OBRAS CIVILES">OBRAS CIVILES</option>
             <option value="VARIOS">VARIOS</option>
             <option value="PERSONAL CACAY">PERSONAL CACAY</option>


        </select>

    </div>
                    
                <br>    
                <br>
                    <button type="submit" class="btn btn-primary">Consulta</button>
                </form>

      </div>
      <div class="modal-footer">
        <i>Desarrollado por Sistemas</i>
      </div>
    </div>
  </div>
</div>


     

 <br>
 <br>

 
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#informegeneral" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Informe General</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#porareas" type="button" role="tab" aria-controls="profile" aria-selected="false">Areas</button>
  </li>
<!--   <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Costo SSL Vs Empleado</button>
  </li> -->

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="informegeneral" role="tabpanel" aria-labelledby="home-tab">

      @include('payroll.informegeneral')


  </div>
  <div class="tab-pane fade" id="porareas" role="tabpanel" aria-labelledby="profile-tab">
      
      @include('payroll.areas')

  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> Pendiente por revisión con Andrés.</div>
</div>

</div> <!-- Cierra el container -->




    @endsection
