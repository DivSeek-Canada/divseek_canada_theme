
// PURPOSE: Provides javascript to add allow users to select a crop.
(function ($) {
  Drupal.behaviors.divseekcanadathemeFrontpageCropSelect = {
    attach: function (context, settings) {

      // Add GET parameters to tool links in page.
      // This ensures that when a tool is clicked it is automatically filtered
      // for the selected crop.
      function updateToolURLs(cropCard) {
        $(".tool a.tool-url").each(function(i, obj) {

          // Get the URL to change...
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
        
        // Set the URL for the genotype matrix.
        // This needs to be done separately because it doesn't use the query string
        // for the genus but rather has it as part of the path.
        // It's disabled on start b/c there is no genotype matrix which is not crop-specific.
        genus = cropCard.data("genus");
        matrixTool = $(".tool.genotype-matrix");
        matrixTool.removeClass("disabled");
        newUrl = matrixTool.data("matrix-url") + "/" + genus;
        $(".tool.genotype-matrix a").attr("href", newUrl);
        
        // Disable tools for which we currently have no data.
        // @todo make this dynamic based on the database (likely an mview)
        $(".tool").removeClass("disabled");
        if ((genus == 'Linum') || (genus == 'Helianthus')) {
          $(".tool.genetic-map-search").addClass("disabled");
          $(".tool.mapviewer").addClass("disabled");
          $(".tool.trait-qtl-markers").addClass("disabled");
          $(".tool.genotype-matrix").addClass("disabled");
          $(".tool.marker-search").addClass("disabled");
        }

      }

      // When a crop card is clicked, Set the GET parameters and update URLs.
      $("#crops-navpane .card").click(function(){

        // Ensure the new crop is the only one indicated as selected.
        $("#crops-navpane .card").removeClass("selected");
        $(this).addClass("selected");

        // Add the new crop to the URL for use with updating tool links.
        // This is done using pushState to avoid a page reload.
        if ('URLSearchParams' in window) {
            searchParams = new URLSearchParams(window.location.search)
            searchParams.set("genus", $(this).data("genus"));
            searchParams.set("crop", $(this).data("crop"));
            searchParams.set("traitcat", $(this).data("traitcat"));
            newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
            history.pushState(null, '', newRelativePathQuery);

            // Now update the tool links to match the new crop.
            updateToolURLs($(this));
        }
      });

      // Call updateToolURLs() on load if GET parameters are set.
      // This ensures the tool links match the currently selected crop.
      searchParams = new URLSearchParams(window.location.search)
      if (searchParams.has("genus")) {
        genus = searchParams.get("genus");
        cropCard = $("#crops-navpane .card[data-genus=" + genus + "]");
        updateToolURLs(cropCard);
      }
    }
  };
}(jQuery));
