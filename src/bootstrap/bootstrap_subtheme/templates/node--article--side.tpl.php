<li>	
	<a href="<?php print $node_url; ?>">
		<span style="font-size:0.8em;">
			<?php print format_date($node->created, 'custom', 'j/m/Y'); ?>
		</span>
	</a>

	<br>

	<a href="<?php print $node_url; ?>">
		<strong><?php print $title; ?></strong>
	</a>

	<br>

	<a href="<?php print $node_url; ?>">
		<span style="font-size:0.8em;"><?php print render($content['field_retranca']); ?></span>
	</a>
</li>

