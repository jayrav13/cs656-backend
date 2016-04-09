$(document).ready(function() {
    $.ajax({
        url: 'http://ihlp.dev/api/v0.1/user/register',
        type: 'POST',
        data: {
            'name' : 'Blah',
            'email' : 'diff@gmail.com',
            'password' : 'testing'
        },
        success: function(data) {

        },
        error: function(data) {

        },
        complete: function(data) {
            console.log(data);
        }
    })
});