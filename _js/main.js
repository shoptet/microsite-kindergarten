$(document).ready(function(){

    /* RESPONSIVE MENU .RESPONSIVE-NAV SCRIPT START */
    var moreMenuDropdown = '<button class="btn"><div class="fas fa-bars"></div></button><ul class="hidden-links hidden"></ul>';

    $('body').find('.responsive-nav').each(function() {
        $(this).append(moreMenuDropdown);
    });

    var menus = {};

    $('body').find('.responsive-nav').each(function(index, value) {
        menus[index] = value;
        menus[index]['nav'] = $(this);
        menus[index]['btn'] = $("button", this);
        menus[index]['vlinks'] = $(".visible-links", this);
        menus[index]['hlinks'] = $(".hidden-links", this);
        menus[index]['breaks'] = [];

        menus[index]['btn'].on('click', function() {
            menus[index]['hlinks'].toggleClass('hidden');
        });

        updateNav(index);
    });

    function updateNav(index) {
        // Count visible menus only
        if(menus[index]['nav'].width() > 0) {
            var availableSpace = menus[index]['btn'].hasClass('hidden') ? menus[index]['nav'].width() : menus[index]['nav'].width() - menus[index]['btn'].width() - 40;

            // The visible list IS overflowing the nav
            if(menus[index]['vlinks'].width() > availableSpace) {

                // Record the width of the list
                menus[index]['breaks'].push(menus[index]['vlinks'].width());

                // Move item to the hidden list
                menus[index]['vlinks'].children().last().prependTo(menus[index]['hlinks']);

                // Show the dropdown btn
                if(menus[index]['btn'].hasClass('hidden')) {
                    menus[index]['btn'].removeClass('hidden');
                }

            // The visible list IS NOT overflowing
            } else {

                // There is space for another item in the nav
                var breaksPosition = menus[index]['breaks'].length - 1;
                if(availableSpace > menus[index]['breaks'][breaksPosition]) {

                    // Move the item to the visible list
                    menus[index]['hlinks'].children().first().appendTo(menus[index]['vlinks']);
                    menus[index]['breaks'].pop();
                }

                // Hide the dropdown btn if hidden list is empty
                if(menus[index]['breaks'].length < 1) {
                    menus[index]['btn'].addClass('hidden');
                    menus[index]['hlinks'].addClass('hidden');
                }
            }

            // Recursive if the visible list is still overflowing the nav
            if(menus[index]['vlinks'].width() > availableSpace) {
                updateNav(index);
            }
        }
    }

    $(window).resize(function() {
        $('body').find('.responsive-nav').each(function(index, value) {
            updateNav(index);
        });
    });

    /* RESPONSIVE MENU .RESPONSIVE-NAV SCRIPT END */

});
