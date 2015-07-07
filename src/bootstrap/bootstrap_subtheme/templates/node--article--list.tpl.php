
<?php
	$image = field_get_items('node', $node, 'field_image');
	if ($image) {
		$imgOutput = field_view_value('node', $node, 'field_image', $image[0], array(
		  'type' => 'image',
		  'settings' => array(
		    'image_style' => 'thumbnail',
		  ),
		));
	}
?>

<div class="col-">

	<div id="node-article-list" class="node-article-list">

		<h4>
			<a href="<?php print $node_url; ?>">
				<span class="data">
					<?php print format_date($node->created, 'custom', 'j/m/Y'); ?>
				</span>
			<?php print $title;?></a>
		</h4>
		
		<p>
			<a href="<?php print $node_url; ?>"><?php print render($content['field_retranca']);?></a>
		</p>
		
	</div>

	<div class="">
		
		<a href="<?php print $node_url; ?>">
			<?php print render($imgOutput); ?>
		</a>
		
	</div>


</div>

<br>
