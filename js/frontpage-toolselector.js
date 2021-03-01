
// PURPOSE: Provides javascript to add allow users to select a crop.
(function ($) {
  Drupal.behaviors.divseekcanadathemeFrontpageCropSelect = {
    attach: function (context, settings) {

      // Add GET parameters to URLs in page.
      function updateToolURLs(cropCard) {
        $(".tool a.tool-url").each(function(i, obj) {

          // -- Get the URL to change...
          url = $(this).data("baseurl");
          qparam = $(this).data("qparamkey");

          // If we don't have the query value, then get it from the crop card.
          qparamType = $(this).data("qparamtype");
          value = cropCard.data(qparamType);

          // Now generate the query paramters format.
          searchParams = new URLSearchParams({
            [qparam]: value,
          });

          // Finally, create the URL.
          newUrl = url + "?" + searchParams.toString();
          $(this).attr("href", newUrl);
        });
        
        genus = cropCard.data("genus");
        matrixTool = $(".tool.genotype-matrix");
        matrixTool.removeClass("disabled");
        newUrl = 'chado/genotype/' + genus;
        matrixTool.attr("href", newUrl);
      }

      // When a crop card is clicked, Set the GET parameters and update URLs.
      $("#crops-navpane .card").click(function(){

        $("#crops-navpane .card").removeClass("selected");
        $(this).addClass("selected");

        if ('URLSearchParams' in window) {
            searchParams = new URLSearchParams(window.location.search)
            searchParams.set("genus", $(this).data("genus"));
            searchParams.set("crop", $(this).data("crop"));
            searchParams.set("traitcat", $(this).data("traitcat"));
            newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);

            updateToolURLs($(this));
        }
      });

      // Call updateToolURLs() on load if GET parameters are set.
      searchParams = new URLSearchParams(window.location.search)
      if (searchParams.has("genus")) {
        genus = searchParams.get("genus");
        cropCard = $("#crops-navpane .card[data-genus=" + genus + "]");
        updateToolURLs(cropCard);
      }

      // @TODO: Disable/Enable tools based on if they have data for a crop.

    }
  };
}(jQuery));
