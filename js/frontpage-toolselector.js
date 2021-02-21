
// PURPOSE: Provides javascript to add allow users to select a crop.
(function ($) {
  Drupal.behaviors.divseekcanadathemeFrontpageCropSelect = {
    attach: function (context, settings) {

      // When a crop card is clicked, Set the GET parameters.
      $("#crops-navpane .card").click(function(){

        if ('URLSearchParams' in window) {
            var searchParams = new URLSearchParams(window.location.search)
            searchParams.set("genus", $(this).data("genus"));
            searchParams.set("crop", $(this).data("crop"));
            var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);
        }

      });

      // @TODO: Add get parameters to URLs in page.
      
      // @TODO: Disable/Enable tools based on if they have data for a crop.

    }
  };
}(jQuery));
