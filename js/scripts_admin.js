$(document).ready(function()
{
    var page;
    $('#orders').click(function()
    {
        $('#orders').addClass('active');
        $('#comments').removeClass('active');
        $('#articles').removeClass('active');
        $('#admins').removeClass('active');
        page='orders';
        ChangePage(page);
    });
    $('#comments').click(function()
    {
        $('#comments').addClass('active');
        $('#orders').removeClass('active');
        $('#articles').removeClass('active');
        $('#admins').removeClass('active');
        page='comments';
        ChangePage(page);
    });
    $('#articles').click(function()
    {
        $('#articles').addClass('active');
        $('#comments').removeClass('active');
        $('#orders').removeClass('active');
        $('#admins').removeClass('active');
        page='articles';
        ChangePage(page);
    });
    $('#admins').click(function()
    {
        $('#admins').addClass('active');
        $('#comments').removeClass('active');
        $('#articles').removeClass('active');
        $('#orders').removeClass('active');
        page='admins';
        ChangePage(page);
    });

    // DELIVERY
    $('.nd_result').on('click','.nd_deliver',function()
    {
        $('#confirm_delivery').modal('show');

    });

    $('#nd_confirm_deliver').click(function()
    {
        var order_id=$('.nd_deliver').val();

        $.ajax(
            {
                type: 'POST',
                url: 'admin_pages.php',
                success: OrderSuccess,
                error: AdminError,
                data: "order_id="+order_id,
                dataType: 'html'
            }
        );
        $('#nd_confirm_deliver').hide();
    });

    // COMMENTS
    $('.nd_result').on('click','.nd_go_to',function()
    {
        var article_id=$('.nd_go_to').val();
        window.location.replace('shop.php?a='+article_id);
    });
});

function ChangePage(page)
{
    $.ajax(
        {
            type: 'POST',
            url: 'admin_pages.php',
            success: AdminSuccess,
            error: AdminError,
            data: "page="+page,
            dataType: 'html'
        }
    );
}

function AdminSuccess(data,status,xhr)
{
    $('.nd_result').html(data);
}

function OrderSuccess(data,status,xhr)
{
    $('#nd_delivery_text').html(data);
}

function AdminError(xhr,status,error)
{
    alert('An error has occurred: '+error);
}