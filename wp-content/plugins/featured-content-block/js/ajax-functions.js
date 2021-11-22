jQuery(document).ready(function($) {

    // Ajax filter featured content block
    $('li.filter-term-item').click(function(){
        var catId = $(this).data('term-id')
        console.log(catId);

        $.ajax({
            url : myajax.url,
            data: {
                action : 'block-post-filter',
                cat_id : catId
            },
            type : 'POST',
            success : function( data ){
                console.log('AJAX')
                $( '.featured-content-wrapper' ).html(data);
            }
        });

    })


    // Ajax load more filtered search block
    $('#more_filtered_posts').click(function(){
        var catId = $(this).attr('data-category')
        var perPage = $(this).attr('data-per-page')
        var searchWord = $(this).attr('data-search')
        var pageNum = $(this).attr('data-page-number')

        $.ajax({
            url : myajax.url,
            data: {
                action : 'more-filtered-posts',
                cat_id : catId,
                per_page : perPage,
                search : searchWord,
                page_num : ++pageNum
            },
            type : 'POST',
            success : function( data ){

                var response = $.parseJSON(data);

                $( '.filtered_content_search-wrapper' ).append(response.articles);
                $('#more_filtered_posts').attr('data-page-number', pageNum);
                if (response.more_pages != true) {
                    $('.filtered_content_search__load-more').hide();
                } else {
                    $('.filtered_content_search__load-more').show();
                }
            }
        });

    })

    // Ajax filter for filtered search block
    $('.search-content-filter-wrapper .filter-category-item').click(function(){
        var catId = $(this).attr('data-term-id')
        var perPage = $('#more_filtered_posts').attr('data-per-page')
        var searchWord = $('#more_filtered_posts').attr('data-search')
        var pageNum = 1

        $.ajax({
            url : myajax.url,
            data: {
                action : 'more-filtered-posts',
                cat_id : catId,
                per_page : perPage,
                search : searchWord,
                page_num : pageNum
            },
            type : 'POST',
            success : function( data ){

                var response = $.parseJSON(data);

                $( '.filtered_content_search-wrapper' ).html(response.articles);
                $('#more_filtered_posts').attr('data-category', catId);
                $('#more_filtered_posts').attr('data-page-number', pageNum);

                if (response.more_pages != true) {
                    $('.filtered_content_search__load-more').hide();
                } else {
                    $('.filtered_content_search__load-more').show();
                }
            }
        });

    })


    // Ajax search for filtered search block
    $('#search_btn_filterd').click(function(){
        var catId = 0
        var perPage = $('#more_filtered_posts').attr('data-per-page')
        var searchWord = $('#filtered_post_search').val()
        var pageNum = 1

        $.ajax({
            url : myajax.url,
            data: {
                action : 'more-filtered-posts',
                cat_id : catId,
                per_page : perPage,
                search : searchWord,
                page_num : pageNum
            },
            type : 'POST',
            success : function( data ){

                var response = $.parseJSON(data);

                $( '.filtered_content_search-wrapper' ).html(response.articles);
                $('#more_filtered_posts').attr('data-search', searchWord);
                $('#more_filtered_posts').attr('data-page-number', pageNum);
                $('#more_filtered_posts').attr('data-category', catId);

                if (response.more_pages != true) {
                    $('.filtered_content_search__load-more').hide();
                } else {
                    $('.filtered_content_search__load-more').show();
                }
            }
        });

    })


    // Ajax filter for our explorations block
    $('.our-explorations-filter-wrapper .filter-category-item').click(function(){
        var catId = $(this).attr('data-term-id');
        var perPage = -1;
        var pageNum = 1;

        $.ajax({
            url : myajax.url,
            data: {
                action : 'filter-explorations',
                cat_id : catId,
            },
            type : 'POST',
            success : function( data ){

                var response = $.parseJSON(data);
                $( '.our_explorations_content-wrapper' ).html(response.articles);
            }
        });

    })

});
