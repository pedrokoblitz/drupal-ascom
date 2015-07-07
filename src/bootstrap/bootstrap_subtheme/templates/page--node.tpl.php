<?php global $base_url; ?>

<!-- PAGINA INICIO -->


<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="container">
    <div class="navbar-header">
      <?php if ($logo): ?>
      <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
      <?php endif; ?>

      <?php if (!empty($site_name)): ?>
      <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      <?php endif; ?>

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
      </div>
    <?php endif; ?>
  </div>
</header>

<?php


	if ($n = menu_get_object()) {
		$nid = $n->nid; // ID do nó atual
	}

?>
<div id="conteudo" class="container">


  <header role="banner" id="page-header">
    <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <?php print render($page['header']); ?>
  </header> <!-- /#page-header -->

	
	<div class="row clearfix">
	
		<div id="" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <section<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php 
		if (isset($node) && $node->type == 'article') {

				$image = field_get_items('node', $node, 'field_image');
				if ($image && !$is_front) {
					$imgOutput = field_view_value('node', $node, 'field_image', $image[0], array(
					  'type' => 'image',
					  'settings' => array(
						'image_style' => 'large',
					  ),
					));
					print render($imgOutput);
				}

			?>

			<?php print render($content['body']); // ?>

			<?php if (isset($content['field_gallery'])) : // ?>


				<?php $images = field_get_items('node', $node, 'field_gallery'); ?>

				<?php
					$gallery = array();
					if ($images && !$is_front) {
						foreach ($images as $img) {
							$gallery[] = field_view_value('node', $node, 'field_gallery', $img, array(
							  'type' => 'image',
							  'settings' => array(
								'image_style' => 'large',
							  ),
							));
						}
						print render($galeria);
					}

				?>

			<?php endif; 

		} else {
			print render($page['content']); 
		}

      
      ?>
    </section>
    
		</div>
		

		<div id="" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<?php
				if (isset($node) && $node->type == 'article') {
					print render($page['sidebar_articles']); 
				}

				else {
					print render($page['sidebar_first']); 

					print render($page['sidebar_second']); 
				}

			?>
		</div>

	</div>
</div>

<footer class="footer container">
  <?php print render($page['footer']); ?>
</footer>

