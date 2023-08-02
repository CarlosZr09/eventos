<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Calendario</h5>
            </div>
            <div class="card-body">
                <div id='calendar'>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalEvent">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Modal title</h5>
      </div>
      <form action="<?php echo base_url();?>events/create" method="post" id="eventForm" novalidate="novalidate">

      <div class="modal-body">
            <div class="form-group">
                <label for="titleEvent">Titulo</label>
                <input type="text" class="form-control" id="titleEvent" name="titleEvent" required>
            </div>
            <div class="form-group">
                <label>Fecha:</label>
                <input type="text" class="form-control datetimepicker-input" id="dateEvent" name="dateEvent" readonly required/>
                    
            </div>
            <div class="form-group">
                <label for="descriptionEvent">Descripción</label>
                <textarea type="text" class="form-control" id="descriptionEvent" name="descriptionEvent" required></textarea>
            </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Guardar</button>
      </div></form>
    </div>
  </div>
</div>