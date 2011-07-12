<?php
/**
 * Main content filter
 *
 * Select between user, friends, and all content
 *
 * @uses $vars['filter_context']  Filter context: all, friends, mine
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['context']         Page context (override)
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$context = elgg_extract('context', $vars, elgg_get_context());

if (elgg_is_logged_in() && $context) {
	$filter_context = elgg_extract('filter_context', $vars, 'all');

	// generate a list of default tabs
	$tabs = array(); $priority = 2;
	$tabs['refresh-all'] = array(
		'text' => elgg_view_icon('refresh'),
		'href' => '#',
		'class' => "elgg-refresh-all-button",
		'selected' => 1,
		'priority' => $priority * 100,
	);
	$priority++;
	foreach ($vars['user_river_options'] as $name => $tab) {
		$tabs[$name] = array(
			'text' => $name,
			'href' => (isset($vars['all_link'])) ? $vars['all_link'] : "$context/$name",
			'selected' => ($filter_context == $name),
			'priority' => $priority * 100,
		);
		$priority++;
	}
	$tabs['plus'] = array(
		'text' => '+',
		'href' => '#add-deck-river-tab',
		'rel' => 'popup',
		'selected' => 0,
		'priority' => $priority * 100,
	);

	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		
		elgg_register_menu_item('filter', $tab);
	}

	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-deck-river'));
}