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
    
});