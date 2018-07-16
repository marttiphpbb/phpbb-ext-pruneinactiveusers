<?php

/**
* phpBB Extension - marttiphpbb Prune Inactive Users
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [

	'ACP_MARTTIPHPBB_PRUNEACTIVEUSERS_SETTING_SAVED'
		=> 'The setting was saved.',
	'ACP_MARTTIPHPBB_PRUNEACTIVEUSERS_DAYS'
		=> 'Days',
	'ACP_MARTTIPHPBB_PRUNEACTIVEUSERS_DAYS_EXPLAIN'
		=> 'Newly registered users that were never activated will be
		deleted after this amount of days.',

]);
