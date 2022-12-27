jQuery(function ($) {
    $('.head-category-navigation').on('click', () => {
        $('.head-categories').slideToggle();
        $('.head-categories').find('a').on('click', function () {
            let catID = $(this).parent().attr('data-id');
            let catName = $(this).parent().attr('data-name');
            let catSlug = $(this).parent().attr('data-slug');
            $(this).closest('.head-categories').prev('.category-button').children('span').text(catName);
        })
    })
});