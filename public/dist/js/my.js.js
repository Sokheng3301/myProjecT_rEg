$('select.dropdown').dropdown();
$('select.dropdown1').dropdown();
$('select.dropdown2').dropdown();
$('select.dropdown3').dropdown();
$('select.dropdown4').dropdown();
$('select.dropdown5').dropdown();
$( "#datepicker" ).datepicker();
$( "#birth_date_spouse" ).datepicker();
// $( "#datepicker1" ).datepicker();
// $( "#datepicker2" ).datepicker();
// $( "#datepicker3" ).datepicker();

// for(var i =1; i<=10000; i++){
//     $('.ui.dropdown'+i).dropdown();
// }

$(document).ready(function () {
    for (var i = 1; i <= 50; i++) {
        $("#datepicker" + i).datepicker();
        $("#workdate" + i).datepicker();
        $("#recieveDate" + i).datepicker();
        $("#pedagogyCourse" + i).datepicker();
        $("#course_start_date" + i).datepicker();
        $("#course_finish_date" + i).datepicker();
        $("#childBirthDate" + i).datepicker();
        $("#datepicker_" + i).datepicker();
        $("#professional_recieve_date_" + i).datepicker();
        $("#workStartdate" + i).datepicker();
        $("#workFinishdate" + i).datepicker();
        $("#PraiseBlamerecieveDate" + i).datepicker();
        $("#cultural_recieveDate" + i).datepicker();
        $("#last_interest_date" + i).datepicker();
        $('#birth_date'+i).datepicker();

    }
    $("#dated").datepicker();
});
// $( "#datepicker7" ).datepicker();
// $( "#datepicker8" ).datepicker();
// $( "#datepicker9" ).datepicker();
// $( "#datepicker10" ).datepicker();
// $( "#datepicker11" ).datepicker();
// $( "#datepicker12" ).datepicker();
// $( "#datepicker13" ).datepicker();
// $( "#datepicker14" ).datepicker();
// $( "#datepicker15" ).datepicker();
// $( "#datepicker16" ).datepicker();
// $('#preload-submit').hide();

$('form').submit(function() {
    var submitButton = $('button[type="submit"]');
    submitButton.prop('disabled', true);
    submitButton.addClass('loading');

    setTimeout(function() {
        submitButton.prop('disabled', false);
        submitButton.removeClass('loading');
    }, 3000);
});

// $(document).ready(function () {
//     $('form select, form input').attr('disabled', true).css('cursor', 'not-allowed');
// });
