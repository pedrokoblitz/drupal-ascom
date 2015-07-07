<?php $image = field_get_items('node', $node, 'field_image'); ?>

<?php
	if ($image) {
		$imgOutput = field_view_value('node', $node, 'field_image', $image[0], array(
		  'type' => 'image',
		  'settings' => array(
		    'image_style' => ($is_front ? 'medium': 'side'),
		  ),
		  
		));
	}

?>
<a href="<?php print $node_url; ?>">
	<?php print render($imgOutput); ?>
</a>
