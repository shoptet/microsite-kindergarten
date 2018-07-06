(function($) {

    $.fn.shpResponsiveNavigation = function() {

        return this.each(function() {

            var $this = $(this),   //this = div .responsive-nav
                maxWidth,
                visibleLinks,
                hiddenLinks,
                button;

            setup($this);

            function setup(resNavDiv) {
                maxWidth = resNavDiv.width();

                // check if menu is even visible before start
                if(maxWidth > 0) {
                    visibleLinks = resNavDiv.find(".visible-links");
                    visibleLinks.find("li").each(function() {
                        $(this).attr("data-width", $(this).width());
                    });

                    //hidden navigation
                    if (!resNavDiv.find(".hidden-links").length) {
                        resNavDiv.append('<button class="btn"><div class="fas fa-bars"></div></button><ul class="hidden-links hidden"></ul>');
                    }
                    hiddenLinks = resNavDiv.find(".hidden-links");
                    button = resNavDiv.find("button");

                    //calculate visible links
                    update(resNavDiv);
                }
            }

            function update(resNavDiv) {
                maxWidth = resNavDiv.width();

                if(visibleLinks.width() > maxWidth) {
                    button.show();
                    var filledSpace = button.width();

                    // push excess to hidden links
                    visibleLinks.find('li').each(function(index) {
                        filledSpace += $(this).data("width");
                        if (filledSpace >= maxWidth) {
                            $(this).appendTo(hiddenLinks);
                        }
                    });


                } else {
                    filledSpace = visibleLinks.width() + button.width();

                    // push missing to visible links
                    hiddenLinks.find('li').each(function(index) {
                        filledSpace += $(this).data("width");
                        if (filledSpace < maxWidth) {
                            $(this).appendTo(visibleLinks);
                        }
                    });

                    if (hiddenLinks.children("li").length == 0) {
                        button.hide();
                    }
                }
            }

            $(window).resize(function() {
                update($this);
            });

            $(button).click(function() {
                hiddenLinks.toggleClass('hidden');
            });
        });
    };

})(jQuery);

$(document).ready(function(){
    $(".responsive-nav").shpResponsiveNavigation();
});

