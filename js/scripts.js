$(document).ready(function()
{
    // FOR LOGIN
    $('#login_form').submit(function(e)
    {
        if(Validation())
        {
            e.preventDefault();
            $('#log_in').modal('hide');

            var user=$('#username').val().trim();
            var pass=$('#password').val().trim();
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

    // FOR REGISTRATION
    $('#register-form').submit(function(e)
    {
        if(ValidationRegister())
        {
            e.preventDefault();
            $('#register').modal('hide');

            var user=$('#username_register').val().trim();
            var email=$('#email_register').val().trim();
            var pass=$('#password1_register').val().trim();
            var f_name=$('#f_name_register').val().trim();
            var l_name=$('#l_name_register').val().trim();
            var address=$('#address_register').val().trim();

            $.ajax(
                {
                    type: 'POST',
                    url: 'register.php',
                    success: RegisterSuccess,
                    error: Error,
                    data:
                    "user="+user+
                    "&email="+email+
                    "&pass="+pass+
                    "&f_name="+f_name+
                    "&l_name="+l_name+
                    "&address="+address,
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

    $('#username_register').change(function()
    {
        if($('#username_register').val().trim().length>=5)
        {
            $('#username_register_div').removeClass('has-error');
            $('#username_register_help').html('');
        }
    });

    $('#email_register').change(function()
    {
        if($('#email_register').val().trim()!='' && isValidEmail($('#email_register').val().trim()))
        {
            $('#email_register_div').removeClass('has-error');
            $('#email_register_help').html('');
        }
    });

    $('#password1_register').change(function()
    {
        if($('#password1_register').val().trim().length>=5 && $('#password1_register').val().trim()==$('#password2_register').val().trim())
        {
            $('#password_register_div').removeClass('has-error');
            $('#password_register_help').html('');
        }
    });

    $('#f_name_register').change(function()
    {
        if($('#f_name_register').val().trim()!='')
        {
            $('#f_name_register_div').removeClass('has-error');
            $('#f_name_register_help').html('');
        }
    });

    $('#l_name_register').change(function()
    {
        if($('#l_name_register').val().trim()!='')
        {
            $('#l_name_register_div').removeClass('has-error');
            $('#l_name_register_help').html('');
        }
    });
});

// FOR LOGIN
/**
 * @return {boolean}
 */
function Validation()
{
    var valid=true;

    if($('#username').val().trim().length<5)
    {
        valid=false;
        $('#username_div').addClass('has-error');
        $('#username_help').html('Please enter your username.');
    }

    if($('#password').val().trim().length<5)
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

//FOR REGISTER
/**
 * @return {boolean}
 */
function ValidationRegister()
{
    var valid=true;

    var user=$('#username_register').val().trim();
    var email=$('#email_register').val().trim();
    var pass1=$('#password1_register').val().trim();
    var pass2=$('#password1_register').val().trim();
    var f_name=$('#f_name_register').val().trim();
    var l_name=$('#l_name_register').val().trim();

    if(user.length<5)
    {
        valid=false;
        $('#username_register_div').addClass('has-error');
        $('#username_register_help').html('Please enter a username that is at least 5 characters long.');
    }

    if(email=='')
    {
        valid=false;
        $('#email_register_div').addClass('has-error');
        $('#email_register_help').html('Please enter an email.');
    }
    else if(!isValidEmail(email))
    {
        valid=false;
        $('#email_register_div').addClass('has-error');
        $('#email_register_help').html('Invalid email format.');
    }

    if(pass1.length<5)
    {
        valid=false;
        $('#password_register_div').addClass('has-error');
        $('#password_register_help').html('Please enter a password that is at least 5 characters long.');
    }
    else if(pass1!=pass2)
    {
        valid=false;
        $('#password_register_div').addClass('has-error');
        $('#password_register_help').html('The passwords don\'t match!');
    }

    if(f_name=='')
    {
        valid=false;
        $('#f_name_register_div').addClass('has-error');
        $('#f_name_register_help').html('Please enter your first name.');
    }

    if(l_name=='')
    {
        valid=false;
        $('#l_name_register_div').addClass('has-error');
        $('#l_name_register_help').html('Please enter your last name.');
    }

    return valid;
}

function isValidEmail(email)
{
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(email);
}

function RegisterSuccess(data,status,xhr)
{
    if(data=='')
    {
        $('#log_in').modal('show');
    }
    else
    {
        $('#error_text').html(data);
        $('#error').modal('show');
    }
}
