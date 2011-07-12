<?php

function deck_river_init() {
	global $CONFIG, $deck_river_original_activity_page_handler;

	elgg_register_library('elgg:river_extended', dirname(__FILE__). '/lib/deck_river_functions.php');
	elgg_load_library('elgg:river_extended');

	elgg_register_library('elgg:deck_river_user_settings', dirname(__FILE__). '/lib/user_settings.php');
	elgg_load_library('elgg:deck_river_user_settings');

	elgg_extend_view('css/elgg','deck_river/css');
	elgg_extend_view('js/elgg', 'deck_river/js');

	$deck_river_original_activity_page_handler = $CONFIG->pagehandler['activity'];
	elgg_register_page_handler('activity', 'deck_river_page_handler');


	$CONFIG->mentions_user_match_regexp = '/[\b]?@([\p{L}\p{M}_\.0-9]+)[\b]?/iu';
	$CONFIG->mentions_group_match_regexp = '/[\b]?!([\p{L}\p{M}_\.0-9]+)[\b]?/iu';

	//register_plugin_hook('output', 'page', 'mentions_user_rewrite');
	//register_plugin_hook('output', 'page', 'mentions_group_rewrite');


}

function deck_river_page_handler($page) {
	global $CONFIG, $deck_river_original_activity_page_handler;

	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

	$page_type = elgg_extract(0, $page, 'all');
	if ($page_type == 'owner') {
		$page_type = 'mine';
	}

	// content filter code here
	$entity_type = '';
	$entity_subtype = '';

	require_once dirname(__FILE__) . '/pages/river.php';
	return true;
}

function mentions_user_rewrite($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;

	$returnvalue = preg_replace_callback($CONFIG->mentions_user_match_regexp,
		create_function(
			'$matches',
			'
				global $CONFIG;
				if ($user = get_user_by_username($matches[1])) {
					return "<a href=\"{$user->getURL()}\">{$matches[0]}</a>";
				} else {
					return $matches[0];
				}
			'
	), $returnvalue);

	return $returnvalue;
}

function mentions_group_rewrite($hook, $entity_type, $returnvalue, $params) {
	global $CONFIG;

	$returnvalue = preg_replace_callback($CONFIG->mentions_group_match_regexp,
		create_function(
			'$matches',
			'
				global $CONFIG;
				$db_prefix = elgg_get_config("dbprefix");
				$query = "SELECT * from {$CONFIG->dbprefix}groups_entity where name = \'{$matches[1]}\'";
				$dt = get_data($query, "entity_row_to_elggstar");
				if (count($dt) === 1) {
					return "<a href=\"groups/profile/{$dt[0]->guid}/{$matches[1]}\">{$matches[0]}</a>";
				} elseif (count($dt) > 1) {
					return "<a href=\"groups/profile/xxxx/{$matches[1]}\">{$matches[0]}</a>";
				} else {
					return $matches[0];
				}
			'
	), $returnvalue);

	return $returnvalue;
}

register_elgg_event_handler('init','system','deck_river_init');