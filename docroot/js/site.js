/**
 * Created by markus on 9.03.16.
 */
$().ready(function() {
    // validate registration form
    $(".reservationForm").validate({
        rules: {
            person_name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            restaurant: "required",
            duration: "required",
            reservation_datetime: "required",
            reservation_way: "required",
            guests_number: {
                required: true,
                max: 50,
                min: 1
            }

        },
        messages: {
            restaurant: "!",
            person_name: "Lenght 2-50 letters",
            details: "Too long"
        }
    });
    
    jQuery('#datetimepicker6').datepicker({
        firstDay:1,
        dateFormat: "dd.mm.yy",
        onClose: function( selectedDate ) {
            jQuery( "#datetimepicker7" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    jQuery('#datetimepicker7').datepicker({
        firstDay:1,
        dateFormat: "dd.mm.yy",
        onClose: function( selectedDate ) {
            jQuery( "#datetimepicker6" ).datepicker( "option", "maxDate", selectedDate );}
    });
    jQuery('.input-group-addon.filterFrom').click(function(){
        jQuery('#datetimepicker6').val(null);
        jQuery('#datetimepicker7').datepicker({
            minDate: null
        });
    });
    jQuery('.input-group-addon.filterTo').click(function(){
        jQuery('#datetimepicker7').val(null);
        jQuery('#datetimepicker6').datepicker({
            maxDate: null
        });
    });
    
});