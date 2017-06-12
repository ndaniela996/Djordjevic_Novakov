$(document).ready(function()
{
    ChangeType('all');
});

function ChangeType(type)
{
    $.ajax(
        {
            type: 'POST',
            url: 'shop_pages.php',
            success: TypeSuccess,
            error: Error,
            data: "type="+type,
            dataType: 'html'
        }
    );
}

function Error(xhr,status,error)
{

}

function TypeSuccess(data,status,xhr)
{
    $('#shop_area').html(data);
}