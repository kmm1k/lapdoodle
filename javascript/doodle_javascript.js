var countCustomInputs = 0;
var custom_to_add = new Array();
$('.date').datepicker({
	clearBtn: true,
    multidate: true,
	language: "et",
	todayBtn: "linked",
	orientation: "bottom auto",
	toggleActive: true
});

$('#doodle_checkbox').click(function(){
    var dateDataRefresher;
	if ($('#doodle_checkbox').is(':checked')) {
		$('.dates_poll').show();
        dateDataRefresher = setInterval(updatePollInputDates, 500);
	} else {
		$('.dates_poll').hide();
        clearInterval(dateDataRefresher);
        $("#dates").val("");
	}
});

$('#custom_checkbox').click(function(){
    var customDataRefresher;
    if ($('#custom_checkbox').is(':checked')) {
        $('.custom_polls').show();
        customDataRefresher = setInterval(updatePollInputCustom, 1000);
    } else {
        $('.custom_polls').hide();
        clearInterval(customDataRefresher);
        //$("#custom").val("");
    }
});

function updatePollInputCustom() {

    if (countCustomInputs > 0) {
        //console.log($('.custom_polls'+':eq('+(countCustomInputs-1)+')').val());
        if ($('.custom_polls'+':eq('+(countCustomInputs-1)+')').val() != "") {
                countCustomInputs++;
            $('#make_new_poll_button').append(
                '<input class="custom_polls" id="custom_poll_' +
                countCustomInputs +
                '" type="text" value="">'
            );
        }
        //console.log($('.custom_polls'+':eq('+(countCustomInputs-2)+')').val());
        console.log(custom_to_add);
        if (countCustomInputs > 1) {
            if ($('.custom_polls' + ':eq(' + (countCustomInputs - 2) + ')').val() == "") {
                $('.custom_polls' + ':eq(' + (countCustomInputs - 1) + ')').remove();
                countCustomInputs--;
            }
        }

    } else {
        countCustomInputs++;
        $('#make_new_poll_button').append(
            '<input class="custom_polls" id="custom_poll_' +
            countCustomInputs +
            '" type="text"  value="">'
        );
    }
    custom_to_add = JSON.stringify(makeCustomOptionsArray());
    $('#doodle_custom').val(custom_to_add);
}

function makeCustomOptionsArray() {
    var newArray = Array();
    for (var i = 0; i < countCustomInputs-1; i++) {
        newArray.push(
            $('.custom_polls'+':eq('+(i)+')').val());
    }
    return newArray;
}

function updatePollInputDates() {
	var value = $(".dates_poll").datepicker("getDates");
	$('#doodle_dates').val(value);
}

$('.joining-image').click(function(){
	var date = $(this).attr("added_date");
	//alert(date);
	if (!is_in_list(date)) {
		dates_to_add.push(date);
	} else {
        dates_to_add = remove_item(dates_to_add, date);
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

function remove_item(array, date) {
	for(var i = array.length - 1; i >= 0; i--) {
		if(array[i] === date) {
            array.splice(i, 1);
		}
	}
    return array;
}

/**
$(".forms").submit(function(event) {
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
