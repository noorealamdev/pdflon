"use strict";

/* ----------------------------------------------------------------
       Activate Datatables
-----------------------------------------------------------------*/
$(document).ready(function() {
    $('#basic-datatable').DataTable();
});

/* ----------------------------------------------------------------
       Activate Select2
-----------------------------------------------------------------*/
$(document).ready(function() {
    $('.select2').select2();

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
});

/* ----------------------------------------------------------------
      Alert Auto Close
-----------------------------------------------------------------*/

$(function(){
    window.setTimeout(function() {
        $("#alert_message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
});
