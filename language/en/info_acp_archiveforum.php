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

	'ACP_MARTTIPHPBB_PRUNEACTIVEUSERS'					=> 'Prune Inactive Users',
	'ACP_MARTTIPHPBB_PRUNEACTIVEUSERS_SETTINGS'			=> 'Settings',
]);
