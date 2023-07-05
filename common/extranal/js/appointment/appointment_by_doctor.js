"use strict"; 
$(document).ready(function () {
    "use strict"; 
    $(".table").on("click", ".editbutton", function () {

        "use strict"; 
        var iid = $(this).attr('data-id');
        $('#editAppointmentForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'appointment/editAppointmentByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
             success: function (response) {
                  "use strict"; 
            $('#editAppointmentForm').find('[name="id"]').val(response.appointment.id).end()

            $('#editAppointmentForm').find('[name="date"]').val(response.appointment.date).end()
            $('#editAppointmentForm').find('[name="remarks"]').val(response.appointment.remarks).end()
            var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
            $('#editAppointmentForm').find('[name="patient"]').append(option).trigger('change');
            var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
            $('#editAppointmentForm').find('[name="doctor"]').append(option1).trigger('change');
             }
        })
    });
});

$(document).ready(function () {
    "use strict"; 
    var table = $('#editable-sample').DataTable({
        responsive: true,
        dom: "<'