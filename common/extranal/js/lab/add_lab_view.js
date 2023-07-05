"use strict";
$(document).ready(function () {
    "use strict";
    $('.pos_client').hide();
    $(document.body).on('change', '#pos_select', function () {
        "use strict";
        var v = $("select.pos_select option:selected").val()
        if (v === 'add_new') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";
    $('.pos_doctor').hide();
    $(document.body).on('change', '#add_doctor', function () {
        "use strict";
        var v = $("select.add_doctor option:selected").val()
        if (v === 'add_new') {
            $('.pos_doctor').show();
        } else {
            $('.pos_doctor').hide();
        }
    });

});


$(document).ready(function () {
    "use strict";
    $(document.body).on('change', '#template', function () {
        "use strict";
        var iid = $("select.template option:selected").val();
        $.ajax({
            url: 'lab/getTemplateByIdByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var data = myEditor.getData();
                if (response.template.template != null) {
                    var data1 = data + response.template.template;
                } else {
                    var data1 = data;
                }
                myEditor.setData(data1)
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $("#pos_select").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfoWithAddNewOption',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });

    $("#add_doctor").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorWithAddNewOption',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });

});
var myEditor;
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';

                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

});