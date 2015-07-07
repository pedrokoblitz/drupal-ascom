<?php

/*
 * loads nodes inside an array
 */

function ascom_load_nodes($nodes) {
	$result = array();
	foreach ($nodes as $node) {
		$result[] = node_load($node->nid,$node->vid);
	}
	return $result;
}


/*
 * loads rendered views inside an array
 */

function ascom_load_views($nodes,$view_mode=null) {
	$result = array();
	foreach ($nodes as $node) {
		$result[] = node_view($node,$view_mode);
	}
	return $result;
}


/*
 * param array
 * returns render_array (look up "drupal render arrays" in google)
 */

function ascom_efq_adapter($opts) {

	$query = new EntityFieldQuery();

	// entity and type
	$query->entityCondition('entity_type', 'node')
		->entityCondition('bundle', $opts['node type']);

	// filter by tag
	if (isset($opts['tags'])) {
		$query->fieldCondition('field_tags', 'tid', $opts['tags'],'=');
	}

	// order
	$query->propertyOrderBy('created', 'DESC');

	// count per page or ...
	if (isset($opts['pagination']) && $opts['pagination'] === true) {
		$query->pager();
		$pagination = $query->pager;
	}

	// ... count per quantity
	elseif (isset($opts['quant'])) {
		$query->range(0,$opts['quant']);
	}

	// execute query
	$result = $query->execute();

	// output array
	$output = array();

	// if there are any results ...
	if (!empty($result['node'])) {

		// load each node
		$nodes = ascom_load_nodes($result['node']);

		// load node's view
		if (isset($opts['view mode'])) {
			$output['nodes'] = ascom_load_views($nodes,$opts['view mode']);
		} else {
			$output['nodes'] = ascom_load_views($nodes);
		}

		// pagination links
		if (isset($opts['pagination']) && $opts['pagination'] === true) {
			$output['pager']['#markup'] = theme('pager', $pagination);
		}

	// if returns empty set
	} else {
		$output['status']['#markup'] = t('No records found.');
	}
	return $output;
}



/*
 *
 */

function ascom_page_adapter($name) {
	$opts = array(
		'node type' => $name,
		'pagination' => true,
		'view mode' => 'list',
	);
	$output = ascom_efq_adapter($opts);
	return $output;
}



/*
 *
 */
function ascom_block_adapter($nome) {

	/*
	 * home page news carousel
	 */

	$blocks['home_article_carousel'] = function() {
		$opts = array(
			'node type' => 'article',
			'quant' => '5',
			'view mode' => 'carousel',
			'tags' => '1', // 1 -> carousel
		);
		$nodes = ascom_efq_adapter($opts);
		$block = array(
			'subject' => t('Article Carousel'),
			'content' => $nodes,
		);
		return $block;
	};

	/*
	 * list page (side) carousel
	 */

	$blocks['internal_article_carousel'] = function() {
		$opts = array(
			'node type' => 'article',
			'quant' => '3',
			'view mode' => 'carousel',
		);
		$nodes = ascom_efq_adapter($opts);
		$block = array(
			'subject' => t('Internal Article Slider'),
			'content' => $nodes,
		);
		return $block;
	};


	/*
	 * other news list
	 */

	$blocks['latest_articles'] = function() {
		$opts = array(
			'node type' => 'article',
			'view mode' => 'side',
			'quant' => '5',
		);
		$nodes = ascom_efq_adapter($opts);
		$block = array(
			'subject' => t('Latest Articles'),
			'content' => $nodes,
		);
		return $block;
	};


	return $blocks[$nome];
}

?>
