$(document).ready(function()
{
    $('#login_form').submit(function(e)
    {
        if(Validation())
        {
            e.preventDefault();
            $('#log_in').modal('hide');

            var user=$('#username').val();
            var pass=$('#password').val();
            $.ajax(
                {
                    type: 'POST',
                    url: 'login.php',
                    success: LoginSuccess,
                    error: LoginError,
                    data: "user="+user+"&pass="+pass,
                    cache: false,
                    dataType: 'html'
                }
            );
        }
        else
        {
            e.preventDefault();
        }
    });

    $('#username').change(function()
    {
        if($('#username').val().trim().length>=5)
        {
            $('#username_div').removeClass('has-error');
            $('#username_help').html('');
        }
    });

    $('#password').change(function()
    {
        if($('#password').val().trim().length>=5)
        {
            $('#password_div').removeClass('has-error');
            $('#password_help').html('');
        }
    });
});

/**
 * @return {boolean}
 */
function Validation()
{
    var valid=true;

    if($('#username').val().trim()=="" || $('#username').val().trim().length<5)
    {
        valid=false;
        $('#username_div').addClass('has-error');
        $('#username_help').html('Please enter your username.');
    }

    if($('#password').val().trim()=="" || $('#password').val().trim().length<5)
    {
        valid=false;
        $('#password_div').addClass('has-error');
        $('#password_help').html('Please enter your password.');
    }

    return valid;
}

function LoginSuccess(data,status,xhr)
{
    if(data.empty())
    {
        window.location.reload();
    }
    else
    {
        $('#login_error').html(data);
        $('#log_in_error').modal('show');
    }
}

function LoginError(xhr,status,error)
{
    $('#login_error').html('And error occurred while attempting to log in! Please try again.');
    $('#log_in_error').modal('show');
}