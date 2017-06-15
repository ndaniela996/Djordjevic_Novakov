$(document).ready(function()
{
    var page;
    $('#orders').click(function()
    {
        $('#orders').addClass('active');
        $('#comments').removeClass('active');
        $('#money').removeClass('active');
        page='orders';
        ChangePage(page);
    });
    $('#comments').click(function()
    {
        $('#comments').addClass('active');
        $('#orders').removeClass('active');
        $('#money').removeClass('active');
        page='comments';
        ChangePage(page);
    });
    $('#money').click(function()
    {
        $('#money').addClass('active');
        $('#comments').removeClass('active');
        $('#orders').removeClass('active');
        page='money';
        ChangePage(page);
    });

    // DELIVERY
    $('.nd_result').on('click','.nd_deliver',function()
    {
        $('#confirm_delivery').modal('show');
        order_id=this.value;
    });

    $('#nd_confirm_deliver').click(function()
    {
        $.ajax(
            {
                type: 'POST',
                url: 'admin_pages.php',
                success: OrderSuccess,
                error: Error,
                data: "order_id="+order_id,
                dataType: 'html'
            }
        );
        $('#nd_confirm_deliver').hide();
    });

    $('#nd_close_deliver').click(function()
    {
        $('#nd_delivery_text').html("Do you really want to mark this order as delivered and charge the appropriate account?");
        $('#nd_confirm_deliver').show();
        page='orders';
        ChangePage(page);
    });
});

function ChangePage(page)
{
    $.ajax(
        {
            type: 'POST',
            url: 'admin_pages.php',
            success: AdminSuccess,
            error: Error,
            data: "page="+page,
            dataType: 'html'
        }
    );
}

function AdminSuccess(data,status,xhr)
{
    $('.nd_result').html(data);
}

function Error(xhr,status,error)
{
    alert('An error has occurred: '+error);
}

// DELIVERY
function OrderSuccess(data,status,xhr)
{
    $('#nd_delivery_text').html(data);
}

