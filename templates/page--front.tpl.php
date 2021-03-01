<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to main-menu administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
global $base_url;
$theme_images = $base_url . '/' . drupal_get_path('theme', 'divseekcanada_theme') . '/images';

$flax_selected = $lentil_selected = $sunflower_selected = '';
$GET = drupal_get_query_parameters();
if (isset($GET['genus'])) {
  switch($GET['genus']) {
    case 'Linum':
      $flax_selected = 'selected';
      break;
    case 'Lens':
      $lentil_selected = 'selected';
      break;
    case 'Helianthus':
      $sunflower_selected = 'selected';
      break;
  }
}
?>

<script src="https://kit.fontawesome.com/13f2ffbd3d.js" crossorigin="anonymous"></script>

<!-- header -->

<div id="header_wrapper">
  <header id="header" class="clearfix">
    <div class="logo_wrap">
      <?php if ($logo): ?>
        <div id="logo"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>"/></a></div>
      <?php endif; ?>
      <h1 id="site-title">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
        <div id="site-description"><?php print $site_slogan; ?></div>
      </h1>
    </div>
    <?php print render($page['search']) ?>
    <?php print render($page['user_menu']) ?>
    <?php print render($page['contact_no']) ?>
  </header>
</div>

<!-- End Header -->

<?php if ($main_menu): ?>
  <div class="menu-wrap">
    <div class="full-wrap clearfix">
      <nav id="main-menu"  role="navigation">
        <a class="nav-toggle" href="#">Navigation</a>
        <div class="menu-navigation-container">
          <?php $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
            print drupal_render($main_menu_tree);
          ?>
        </div>
        <div class="clear"></div>
      </nav>

    </div>
  </div>
<?php endif; ?>

  <div class="slideshow">
    <?php if ($is_front): ?>
      <?php print render($page['slideshow']); ?>
    <?php endif; ?>
  </div>

<div id="top-area">
    <?php if ($page['top_first'] || $page['top_second'] || $page['top_third']): ?>
      <div class="page-wrap clearfix">
        <?php if ($page['top_first']): ?>
        <div class="column one"><?php print render($page['top_first']); ?></div>
        <?php endif; ?>
        <?php if ($page['top_second']): ?>
        <div class="column two"><?php print render($page['top_second']); ?></div>
        <?php endif; ?>
        <?php if ($page['top_third']): ?>
        <div class="column three"><?php print render($page['top_third']); ?></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if ($page['top_forth'] || $page['top_fifth'] || $page['top_sixth']): ?>
      <div class="page-wrap clearfix">
        <?php if ($page['top_forth']): ?>
        <div class="column four"><?php print render($page['top_forth']); ?></div>
        <?php endif; ?>
        <?php if ($page['top_fifth']): ?>
        <div class="column five"><?php print render($page['top_fifth']); ?></div>
        <?php endif; ?>
        <?php if ($page['top_sixth']): ?>
        <div class="column six"><?php print render($page['top_sixth']); ?></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
</div>

<div id="page-wrap">

  <?php if ($is_front): ?>
    <div class="container-wrap clearfix">
      <?php print render($page['testimonials']); ?>
    </div>
  <?php endif; ?>

  <div id="container">
    <div class="container-wrap">
      <div id="content" class="frontpage-content">

        <!-- Add Directions for how to use the Navigation Pane -->
        <div id="divseek-directions-pane">
          <span id="crops-directions">Select your Crop</span>
          <span id="tools-directions">Then Explore...</span>
        </div>

          <!-- Navigation Pane -->
          <div id="divseek-navpane">
            <div id="crops-navpane">

                <!-- Change this to be dynamic in the preprocess function. -->
                <div class="card<?php print ' '.$flax_selected;?>" data-crop="Flax" data-genus="Linum" data-traitcat="79">
                  <div class="content">
                    <h2 class="title">Flax</h2>
                    <p class="copy">Linum usitatissimum</p>
                  </div>
                </div>

                <div class="card<?php print ' '.$lentil_selected;?>" data-crop="Lentil" data-genus="Lens" data-traitcat="72">
                  <div class="content">
                    <h2 class="title">Lentil</h2>
                    <p class="copy">Lens culinaris</p>
                  </div>
                </div>

                <div class="card<?php print ' '.$sunflower_selected;?>" data-crop="Sunflower" data-genus="Helianthus" data-traitcat="76">
                  <div class="content">
                      <h2 class="title">Sunflower</h2>
                      <p class="copy">Helianthus annuus</p>
                  </div>
                </div>

            </div>

            <div id="tools-navpane">

              <div class="tool">
                <a href="<?php print url('search/germplasm'); ?>"
                  data-baseurl="<?php print url('search/germplasm'); ?>"
                  class="tool-url" data-qparamkey="genus" data-qparamtype="genus">
                  <div class="content">
                      <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-seedling fa-stack-1x fa-inverse"></i>
                      </span>
                      <h2 class="title">Germplasm</h2>
                      <div class="tags">
                        <span class="tag germ">Germplasm Passport</span>
                        <span class="tag pheno">Phenotypic Values</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('search/genetic-maps'); ?>"
                  data-baseurl="<?php print url('search/genetic-maps'); ?>"
                  class="tool-url" data-qparamkey="genus" data-qparamtype="genus">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-map-marked-alt fa-stack-1x fa-inverse"></i>
                    </span>
                    <h2 class="title">Genetic Map</h2>
                      <div class="tags">
                        <span class="tag geno">Genetic Map</span>
                          <span class="tag germ">Germplasm</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('MapViewer'); ?>">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-map-signs fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">MapViewer</h2>
                      <div class="tags">
                        <span class="tag geno">Genetic Map</span>
                        <span class="tag pheno">QTL</span>
                        <span class="tag geno">Genetic Marker</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('search/trait-qtl-markers'); ?>"
                  data-baseurl="<?php print url('search/trait-qtl-markers'); ?>"
                  class="tool-url" data-qparamkey="genus" data-qparamtype="genus">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-layer-group fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">Trait > QTL > Genetic Marker Tool</h2>
                      <div class="tags">
                        <span class="tag pheno">Trait</span>
                        <span class="tag geno">Genetic Map</span>
                        <span class="tag pheno">QTL</span>
                        <span class="tag geno">Genetic Marker</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('search/traits'); ?>"
                  data-baseurl="<?php print url('search/traits'); ?>"
                  class="tool-url" data-qparamkey="trait_category" data-qparamtype="traitcat">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-eye fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">Phenotypic Traits</h2>
                      <div class="tags">
                        <span class="tag pheno">Trait</span>
                        <span class="tag germ">Germplasm</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('phenotypes/trait-distribution'); ?>">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-chart-bar fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">Trait Distribution</h2>
                      <div class="tags">
                        <span class="tag pheno">Trait</span>
                        <span class="tag germ">Germplasm</span>
                        <span class="tag pheno">Phenotypic Values</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool disabled genotype-matrix" data-matrix-url="<?php print url('chado/genotype'); ?>">
                <a href="<?php print url('<front>'); ?>">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-table fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">Genotype Matrix</h2>
                      <div class="tags">
                        <span class="tag geno">Genetic Marker</span>
                        <span class="tag geno">Genotypic data</span>
                      </div>
                  </div>
                </a>
              </div>

              <div class="tool">
                <a href="<?php print url('search/markers'); ?>"
                  data-baseurl="<?php print url('search/markers'); ?>"
                  class="tool-url" data-qparamkey="genus" data-qparamtype="genus">
                  <div class="content">
                    <span class="fa-stack fa-4x">
                      <i class="fas fa-circle fa-stack-2x text-primary"></i>
                      <i class="fas fa-map-marker-alt fa-stack-1x fa-inverse"></i>
                    </span>
                      <h2 class="title">Genetic Markers</h2>
                      <div class="tags">
                        <span class="tag geno">Genetic Marker</span>
                      </div>
                  </div>
                </a>
              </div>

            </div>
          </div>

      </div>
    </div>

  <?php if ($page['bottom_widget_1'] || $page['bottom_widget_2'] || $page['bottom_widget_3']): ?>
    <div id="footer_wrapper" class="footer_block bottom_widget">
        <div id="footer-area" class="full-wrap clearfix">
          <?php if ($page['bottom_widget_1']): ?>
          <div class="column"><?php print render($page['bottom_widget_1']); ?></div>
          <?php endif; ?>
          <?php if ($page['bottom_widget_2']): ?>
          <div class="column two"><?php print render($page['bottom_widget_2']); ?></div>
          <?php endif; ?>
          <?php if ($page['bottom_widget_3']): ?>
          <div class="column"><?php print render($page['bottom_widget_3']); ?></div>
          <?php endif; ?>
        </div>
    </div>
  <?php endif; ?>

</div>


<!-- Footer -->

<div id="footer">

  <?php if ($page['footer_first'] || $page['footer_second'] || $page['footer_third'] || $page['footer_forth']): ?>
    <div id="footer-area" class="full-wrap clearfix">
      <?php if ($page['footer_first']): ?>
      <div class="column"><?php print render($page['footer_first']); ?></div>
      <?php endif; ?>
      <?php if ($page['footer_second']): ?>
      <div class="column two"><?php print render($page['footer_second']); ?></div>
      <?php endif; ?>
      <?php if ($page['footer_third']): ?>
      <div class="column"><?php print render($page['footer_third']); ?></div>
      <?php endif; ?>
      <?php if ($page['footer_forth']): ?>
      <div class="column"><?php print render($page['footer_forth']); ?></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="footer_credit">

    <div id="copyright" class="full-wrap clearfix">
      <div class="copyright">&copy; <?php echo date("Y"); ?> <?php print $site_name; ?>. All Rights Reserved.</div>
    </div>

  </div>
  <div class="credits">
    <?php print t('Design by'); ?><a href="http://www.zymphonies.com"> Zymphonies</a>
  </div>

</div>

 <script src="<?php print drupal_get_path('theme', 'divseekcanada_theme') . '/js/frontpage-toolselector.js'?>"></script>
