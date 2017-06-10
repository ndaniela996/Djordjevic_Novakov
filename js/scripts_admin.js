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

function AdminError(xhr,status,error)
{
    alert('An error has occurred: '+error);
}