jQuery(document).ready(function($) {
    $('#shortcode-featured li.filter-term-item').click(function(e){
        e.preventDefault()
        var catId = $(this).data('term-id')
        //console.log(catId);

        $.ajax({
            url : myajax.url,
            data: {
                action : 'sc-block-post-filter',
                cat_id : catId
            },
            type : 'POST',
            success : function( data ){
                $( '.featured-content-wrapper' ).html(data);
            }
        });

    })
});
