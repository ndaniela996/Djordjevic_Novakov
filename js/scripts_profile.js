$(document).ready(function()
{

    //ACCOUNT MANAGEMENT
    $('#profile_area').on('click','#add_money_submit',function()
    {
        var add=$('#add_money').val().trim();
        if(add!='')
        {
            AddToAccount(add);
        }
    });

    $('#profile_area').on('click','#remove_money_submit',function()
    {
        var remove=$('#remove_money').val().trim();
        if(remove!='')
        {
            RemoveFromAccount(remove);
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
function AddToAccount(add)
{
    $.ajax(
        {
            type: 'POST',
            url: 'profile_pages.php',
            success: AddRemoveSuccess,
            error: Error,
            data: "add="+add,
            dataType: 'html'
        }
    );
}

//REMOVE
function RemoveFromAccount(remove)
{
    $.ajax(
        {
            type: 'POST',
            url: 'profile_pages.php',
            success: AddRemoveSuccess,
            error: Error,
            data: "remove="+remove,
            dataType: 'html'
        }
    );
}

//ADD/REMOVE SUCCESS
function AddRemoveSuccess(data,status,xhr)
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
