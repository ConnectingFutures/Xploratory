var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    withSelect = wp.data.withSelect;

registerBlockType( 'riad/featured-content-block', {
    title: 'Featured content block',
    icon: 'megaphone',
    category: 'common',

    edit: withSelect( function( select ) {
        return {
            posts: select( 'core' ).getEntityRecords( 'postType', 'post' )
        };
    } )( function( props ) {
        if ( props.posts && props.posts.length === 0 ) {
            return "No posts";
        }
        var className = props.className;
        var post = props.posts[ 0 ];

        return el(
            'a',
            { className: className, href: post.link },
            post.title.rendered
        );
    } ),

    save: function() {
        // Rendering in PHP
        return null;
    },
} );