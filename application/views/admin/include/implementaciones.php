<script type="text/javascript">
    <?php $current_controller=$this->router->fetch_class() ?>
    <?php $current_metodo=$this->router->fetch_method() ?>
    <?php if ($current_controller=='events'): ?>
        <?php if ($current_metodo=='index'): ?>
            const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    initialView: 'dayGridMonth',
                    events: '<?php echo base_url()."events/list";?>',
                    dateClick: function(info) {
                        const dateSelected = moment(info.dateStr).format('DD/MM/YYYY');

                        const currentDate = moment().format('DD/MM/YYYY');
                        if (dateSelected>= currentDate) {
                            $("#titleModal").text("Nuevo evento");
                            $("#dateEvent").val(dateSelected);
                            $("#modalEvent").modal("show");
                        }else{
                            Toast.fire({
                                icon: 'warning',
                                title: "No se puede asignar evento a la fecha "+dateSelected
                            });
                        }
                    },
                    eventClick: function(info) {
                        const dateSelected = moment(info.dateStr).format('DD/MM/YYYY');
                        const eventData = info.event.extendedProps;
                        var requestOptions = {
                            method: 'GET'
                        };

                        fetch("<?php echo base_url().'events/get/';?>"+eventData.eventid, requestOptions)
                        .then(response => response.json())
                        .then(result =>{
                            const dateDb = moment(result.date).format('DD/MM/YYYY');
                            $("#titleModal").text("Evento");
                            $("#dateEvent").val(dateDb);
                            $("#titleEvent").val(result.tittle);
                            $("#titleEvent").prop('disabled',true);
                            $("#descriptionEvent").val(result.description);
                            $("#descriptionEvent").prop('disabled',true);
                            $("#modalEvent").modal("show");
                        })
                        .catch(error => console.log('error', error));
                    },
                    eventDrop: function(info) {
                        const eventData = info.event.extendedProps;
                        alert('Evento movido. Nueva fecha: ' + info.event.start);
                    },
                });
                calendar.render();

                

            });
            $(function () {

            $('#eventForm').validate({
                rules: {
                    titleEvent: {
                        required: true
                    },
                    descriptionEvent: {
                        required: true
                    },
                    dateEvent: {
                        required: true
                    }
                },
                messages: {
                    titleEvent: {
                        required: "Por favor, ingrese un titulo."
                    },
                    descriptionEvent: {
                        required: "Por favor, ingrese una descripción."
                    },
                    dateEvent: {
                        required: "Por favor, seleccione el dia."
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }
            });
        });
        <?php if($this->session->flashdata('msg')):?>
            let iconToast = 'success';
            <?php if($this->session->flashdata('error')==1):?>
                iconToast = 'error';
                
            <?php endif ?>
                Toast.fire({
                    icon: iconToast,
                    title: "<?php echo $this->session->flashdata('msg');?>"
                });
            <?php endif ?>
        <?php endif ?>
	<?php endif ?>
    
</script>