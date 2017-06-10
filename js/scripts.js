$(document).ready(function()
{
    // FOR LOGIN
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
                    error: Error,
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

    //FOR LOGOUT
    $('#logout').click(function()
    {
        $.ajax(
            {
                type: 'POST',
                url: 'logout.php',
                success: LogoutSuccess,
                error: Error,
                dataType: 'html'
            }
        );
    });
});

// FOR LOGIN
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
    if(data=='')
    {
        window.location.reload();
    }
    else
    {
        $('#error_text').html(data);
        $('#error').modal('show');
    }
}

function Error(xhr,status,error)
{
    $('#error_text').html('And error occurred! Please try again.');
    $('#error').modal('show');
}

// FOR LOGOUT
function LogoutSuccess(data,status,xhr)
{
    window.location.reload();
}
