/**
 * Created by markus on 9.03.16.
 */
$().ready(function() {
    // validate registration form
    $(".registrationForm").validate({
        rules: {
            details: "required"
        },
        messages: {
            details: "Registration details are mandatory!"
        }
    });
});