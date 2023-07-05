"use strict";
var myEditor;
var myEditor2;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });
  ClassicEditor.create(document.querySelector("#editor1"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor2 = editor;
    })
    .catch((error) => {
      console.error(error);
    });
});
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $.ajax({
      url: "missingpet/editMissingpetByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#editMissingpetForm")
          .find('[name="id"]')
          .val(response.missingpet.id)
          .end();
        $("#editMissingpetForm")
          .find('[name="patient"]')
          .val(response.missingpet.patient)
          .end();
        $("#editMissingpetForm")
          .find('[name="owner"]')
          .val(response.missingpet.owner)
          .end();
        $("#editMissingpetForm")
          .find('[name="type"]')
          .val(response.missingpet.pet_type)
          .end();
        $("#editMissingpetForm")
          .find('[name="phone"]')
          .val(response.missingpet.phone)
          .end();
        $("#editMissingpetForm")
          .find('[name="description"]')
          .val(response.missingpet.description)
          .end();
        myEditor2.setData(response.missingpet.description);

        if (
          typeof response.missingpet.img_url !== "undefined" &&
          response.missingpet.img_url != ""
        ) {
          $("#img").attr("src", response.missingpet.img_url);
        } else {
          $("#img").attr("src", response.patient.img_url);
        }

        $("#patient1").html("");
        $.ajax({
          url:
            "patient/getPatientByOwnerForEdit?id=" +
            response.missingpet.owner +
            "&patient=" +
            response.missingpet.patient,
          method: "GET",
          data: "",
          dataType: "json",
          success: function (response1) {
            $("#patient1").html(response1.response).end();
            // $('#editAppointmentForm').find('[name="visit_description"]').val(response.appointment.visit_description).trigger('change').end();
          },
        });

        $("#myModal2").modal("show");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample").DataTable({
    responsive: true,

    processing: true,
    serverSide: true,
    searchable: true,
    bScrollCollapse: true,
    ajax: {
      url: "missingpet/getMissingpetList",
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },

    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "excelHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "csvHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "pdfHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "print", exportOptions: { columns: [0, 1] } },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: -1,
    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});

$(document).ready(function () {
  "use strict";
  $(".owner_div").on("change", "#owner", function () {
    "use strict";
    var owner = $("#owner").val();

    $("#patient").html(" ");

    $.ajax({
      url: "patient/getPatientByOwner?id=" + owner,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response1) {
        $("#patient").html(response1.response).end();
      },
    });
  });
});

$(document).ready(function () {
    "use strict";
    $(".owner_div1").on("change", "#owner1", function () {
      "use strict";
      var owner = $("#owner1").val();
  
      $("#patient1").html(" ");
  
      $.ajax({
        url: "patient/getPatientByOwner?id=" + owner,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response1) {
          $("#patient1").html(response1.response).end();
        },
      });
    });
  });

$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
});
