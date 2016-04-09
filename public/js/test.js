$(document).ready(function() {
    $.ajax({
        url: 'http://localhost:8000/api/v0.1/user/login',
        type: 'POST',
        data: {
            'email' : 'jhr10@njit.edu',
            'password' : 'testing'
        },
        success: function(data) {

        },
        error: function(data) {

        },
        complete: function(data) {
            console.log(JSON.parse(data["responseText"]));
        }
    })

    $.ajax({
        url: 'http://localhost:8000/api/v0.1/company/companies',
        type: 'GET',
        data: {
            'token' : '841ff8a45f6565777796ecf13cefa815',
        },
        success: function(data) {

        },
        error: function(data) {

        },
        complete: function(data) {
            console.log(JSON.parse(data["responseText"]));
        }
    })
});