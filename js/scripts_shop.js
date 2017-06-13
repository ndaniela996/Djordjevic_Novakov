$(document).ready(function()
{
    type='all';
    page=$('#nd_page').val();
    if($('#nd_searched').length)
    {
        var search=$('#nd_searched').val().trim();
        Search(search);
    }
    else
    {
        ChangeType(type,page);
    }

    //CHANGE PAGES
    $('.previous').addClass('disabled');

    $('.previous').click(function(e)
    {
        e.preventDefault();
        page--;
        $('#nd_page').val(page);
        if(page==1)
        {
            $('.previous').addClass('disabled');
        }
        else
        {
            $('.previous').removeClass('disabled');
        }
        ChangeType(type,page);
    });

    $('.next').click(function(e)
    {
        e.preventDefault();
        page++;
        $('#nd_page').val(page);
        if(page==1)
        {
            $('.previous').addClass('disabled');
        }
        else
        {
            $('.previous').removeClass('disabled');
        }
        ChangeType(type,page);
    });

    //CHANGE TYPES
    $('#nd_type').on('click','button',function()
    {
        type=this.value;
        ChangeType(type,page);
    });

    //COMMENT
    $('#submit_comment').click(function(e)
    {
        e.preventDefault();
        var user=$('#comment_user').val();
        var article=$('#comment_article').val();
        var comment=$('#comment_text').val();

        if(comment.trim()!='')
        {
            $.ajax(
                {
                    type: 'POST',
                    url: 'shop_pages.php',
                    success: CommentSuccess,
                    error: Error,
                    data:
                    "user="+user+
                    "&article="+article+
                    "&comment="+comment,
                    dataType: 'html'
                }
            );
        }
        else
        {
            $('#comment_text').addClass('has-error');
            $('#comment_help').html("Please enter a comment.");
        }
    });

    $('#comment_text').change(function()
    {
        if($('#comment_text').val().trim()!='')
        {
            $('#comment_text').removeClass('has-error');
            $('#comment_help').html('');
        }
    });

    //FOR CART
    $('#cart_add').click(function(e)
    {
        e.preventDefault();
        $('#cart_added').modal('show');

    });

    $('#add_to_cart').submit(function(e)
        {
            e.preventDefault();
            var id=$('#article_id').val();
            var num=$('#num_ordered').val();
            AddCart(id,num);
        }
    );

    $('#close_order').click(function()
    {
        $('#added_cart').html('<label for="num_ordered">How many of these would you like?</label><input type="number" id="num_ordered">');
        $('#order_submit').show();
    });
});

//ERROR FUNCTION
function Error(xhr,status,error)
{
    $('#error_text').html('An error occurred! Please, try again.');
    $('#error').modal('show');
}

//FOR TYPE/PAGE
function ChangeType(type,page)
{
    $.ajax(
        {
            type: 'POST',
            url: 'shop_pages.php',
            success: TypeSuccess,
            error: Error,
            data: "type="+type+"&page="+page,
            dataType: 'html'
        }
    );
}

function TypeSuccess(data,status,xhr)
{
    if(data=='')
    {
        page--;
        $('#nd_page').val(page);
        $('.next').addClass('disabled');
        if(page==1)
        {
            $('.previous').addClass('disabled');
        }
        else
        {
            $('.previous').removeClass('disabled');
        }
        ChangeType(type,page);
    }
    else
    {
        $('#shop_area').html(data);
    }
}

//FOR COMMENT
function CommentSuccess(data,status,xhr)
{
    window.location.reload();
}

//FOR CART
function AddCart(id,num)
{
    $.ajax(
        {
            type: 'POST',
            url: 'cart.php',
            success: CartAddSuccess,
            error: Error,
            data: "add_id="+id+"&num="+num,
            dataType: 'html'
        }
    );
}

function CartAddSuccess(data,status,xhr)
{
    $('#added_cart').html(data);
    $('#order_submit').hide();
}

//FOR SEARCH
function Search(search)
{
    $.ajax(
        {
            type: 'POST',
            url: 'shop_pages.php',
            success: TypeSuccess,
            error: Error,
            data: "search="+search,
            dataType: 'html'
        }
    );
}
