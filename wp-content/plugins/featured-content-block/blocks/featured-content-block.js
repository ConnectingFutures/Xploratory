var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    withSelect = wp.data.withSelect;

registerBlockType( 'riad/featured-content-block', {
    title: 'Featured content block',
    icon: 'megaphone',
    category: 'common',
    // Specifying my block attributes
    attributes: {
        postType: {
            type: 'number',
        },
        taxonomy: {
            type: 'string',
        },
        taxTerms: {
            type: 'object',
        },
    },

    edit: () => {
        // Fetch all posts based on the selected postType.
        const postsOptions = useSelect((select) => {
            const { getEntityRecords } = select('core');
            const { isResolving } = select('core/data');

            const postTypeSlugs = [...postType].map((element) => element.value) ?? [];

            if (!postTypeSlugs.length) {
                return [
                    {
                        label: __('No Filter used', 'slug'),
                        value: '',
                    }
                ]
            }

            const postList = [];

            postTypeSlugs.forEach((postType) => {
                const args = ['postType', postType, {per_page: -1}];

                if (!isResolving('core', 'getEntityRecords', args)) {
                    const result = getEntityRecords('postType', postType, {per_page: -1});

                    if (result !== null) {
                        postList.push(result);
                    }
                }
            });

            if (typeof(postList[0]) !== 'undefined') {
                return [
                    {
                        label: __('No Filter used', 'slug'),
                        value: '',
                    },
                    ...postList[0].map((item) => {
                        if (isEmpty(item)) {
                            return {};
                        } else {
                            return {
                                label: item.title.rendered || '',
                                value: item.id || '',
                            };
                        }
                    }),
                ];
            }
        });
    }

    save: function() {
        // Rendering in PHP
        return null;
    },
} );