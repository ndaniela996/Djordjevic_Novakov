$(document).ready(function()
{
    //ACCOUNT MANAGEMENT
    $('.nd_result').on('click','#add_money_submit',function()
    {
        var user=$('#user').val().trim();
        var add=$('#add_money').val().trim();
        if(add!='' && user!='- Choose user -')
        {
            AddToAccount(user,add);
        }
    });

    $('.nd_result').on('click','#remove_money_submit',function()
    {
        var user=$('#user').val().trim();
        var remove=$('#remove_money').val().trim();
        if(remove!='' && user!='- Choose user -')
        {
            RemoveFromAccount(user,remove);
        }
    });
});

//ERROR
function Error(xhr,status,error)
{
    $('#error_text').html('An error occurred! Please try again.');
    $('#error').modal('show');
}

//ADD
function AddToAccount(user,add)
{
    $.ajax(
        {
            type: 'POST',
            url: 'profile_pages.php',
            success: AddRemoveSuccess,
            error: Error,
            data: "user="+user+"&add="+add,
            dataType: 'html'
        }
    );
}

//REMOVE
function RemoveFromAccount(user,remove)
{
    $.ajax(
        {
            type: 'POST',
            url: 'profile_pages.php',
            success: AddRemoveSuccess,
            error: Error,
            data: "user="+user+"&remove="+remove,
            dataType: 'html'
        }
    );
}

//ADD/REMOVE SUCCESS
function AddRemoveSuccess(data,status,xhr)
{
    if(data=='')
    {
        alert('Success!');
        $('#user').val('- Choose user -');
        $('#add_money').val('');
        $('#remove_money').val('');
    }
    else
    {
        $('#error_text').html(data);
        $('#error').modal('show');
    }
}
