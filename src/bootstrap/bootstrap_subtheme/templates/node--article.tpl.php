<br>

<?php

	/*
	 *  featured image
	 * 
	 */

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
		print 'teste';
			/* 
			 * image gallery
			 * 
			 */
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

<?php endif; ?>

