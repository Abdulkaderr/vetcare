"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editOwnerForm').trigger("reset");
        $.ajax({
            url: 'owner/editOwnerByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editOwnerForm').find('[name="id"]').val(response.owner.id).end();
                $('#editOwnerForm').find('[name="name"]').val(response.owner.name).end();
                $('#editOwnerForm').find('[name="password"]').val(response.owner.password).end();
                $('#editOwnerForm').find('[name="email"]').val(response.owner.email).end();
                $('#editOwnerForm').find('[name="address"]').val(response.owner.address).end();
                $('#editOwnerForm').find('[name="phone"]').val(response.owner.phone).end();
                $('#editOwnerForm').find('[name="nid"]').val(response.owner.nid).end();
                $('#myModal2').modal('show');
            }
        })
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
        url: "owner/getOwner",
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
        { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "print", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      ],
      aLengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      iDisplayLength: 100,
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
    //new table

    var table1 = $("#editable-sample1").DataTable({
      responsive: true,
  
      processing: true,
      serverSide: true,
      searchable: true,
      bScrollCollapse: true,
      ajax: {
        url: "owner/getMyOwners",
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
        { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
        { extend: "print", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      ],
      aLengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      iDisplayLength: 100,
      order: [[0, "desc"]],
  
      language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        url: "common/assets/DataTables/languages/" + language + ".json",
      },
      
    });
    table1.buttons().container().appendTo(".custom_buttons");
  });
  
  $(document).ready(function () {
    "use strict";
  
    $(".flashmessage").delay(3000).fadeOut(100);
  });