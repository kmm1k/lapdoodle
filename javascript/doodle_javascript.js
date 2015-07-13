$('.date').datepicker({
	clearBtn: true,
    multidate: true,
	language: "et",
	todayBtn: "linked",
	orientation: "bottom auto",
	toggleActive: true
});

$('#doodle_checkbox').click(function(){
	if ($('#doodle_checkbox').is(':checked')) {
		$('.dates_poll').show();
        var dateDataRefresher = setInterval(updatePollInput, 500);
	} else {
		$('.dates_poll').hide();
        clearInterval(dateDataRefresher);
        $("#dates").val("");
	}
});


function updatePollInput() {
	var value = $(".dates_poll").datepicker("getDates");
	$('#doodle_dates').val(value);
}

$('.joining-image').click(function(){
	var date = $(this).attr("added_date");
	//alert(date);
	if (!is_in_list(date)) {
		dates_to_add.push(date);
	} else {
		remove_item(date);
	}
	$("#dates").val(dates_to_add);
});

var dates_to_add = new Array();
function is_in_list(date) {
	var in_list = false;
	for (var i = 0; i < dates_to_add.length; i++) {
		if (dates_to_add[i] == date) {
			in_list = true;
			break;
		}
	}
	if  (in_list) return true;
}

function remove_item(date) {
	for(var i = dates_to_add.length - 1; i >= 0; i--) {
		if(dates_to_add[i] === date) {
			dates_to_add.splice(i, 1);
		}
	}
}
/*
$("#go_back_to_polls, #remove_poll_button, #remove_from_poll_button, #add_to_poll_button, #make_new_poll_button, .change_poll_button").submit(function(event) {
    event.preventDefault();
    var values = $(this).serialize();
    $.ajax({
        url: "",
        type: "post",
        data: values,
        success: function(data){
            var html = $(data);
            $("#schedule_app").replaceWith(("#schedule_app", html));
        },
        error:function(){
            alert("Sending command failed." + data);
        }
    });
});
*/