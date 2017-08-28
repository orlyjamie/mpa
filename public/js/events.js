$(document).ready(function() {

    $(".datepicker").datepicker({
        dateFormat: 'dd-mm-yy',
        closeText: "Close",
        showButtonPanel: true
    });

    $('.timepicker').timepicker();

    $('.timepicker').timepicker({
        'timeFormat': 'h:i A',
        'minTime': '10:00am',
        'maxTime': '11:30pm'
    });

    $("#cancel_add").click(function(){
        window.location.replace("http://localhost/~allanhyde/authentication/public/events");
    });

    $("#cancel_edit").click(function(){
        window.location.replace("http://localhost/~allanhyde/authentication/public/events");
    });

    $("#submit_event").click(function(e) {

        e.preventDefault();

        //var source = $("#update_source").val();
        var mode = $("#update_event_mode").val();
        //alert("mode: " + mode);
        var eventId = $("#event_id").val();
        //alert("ID: " + eventId)

        if(mode == 'add') {
            var UpdateUrl = 'http://localhost/~allanhyde/authentication/public/event/add';
        } else if(mode == 'edit'){
            var UpdateUrl = 'http://localhost/~allanhyde/authentication/public/event/edit/' + eventId;
        }

        var datastring = $("#event_update").serialize();

        $.ajax({
            url: UpdateUrl,
            type: "POST",
            data: datastring,
            success: function (response) {
                //alert("RESP: " + response);
                if(response == 'errors'){
                    if(mode == 'edit') {
                        window.location.replace('http://localhost/~allanhyde/authentication/public/event/get/' + eventId);
                    } else if(mode == 'add') {
                        window.location.replace('http://localhost/~allanhyde/authentication/public/event/new');
                    }
                } else if(response == 'ok') {
                    //window.location.replace('http://localhost/~allanhyde/authentication/public/events');
                    window.location.href = 'http://localhost/~allanhyde/authentication/public/events';
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

});