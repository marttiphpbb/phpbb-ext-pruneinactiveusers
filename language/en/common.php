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

	'MARTTIPHPBB_PRUNEACTIVEUSERS_ARCHIVED_FROM'	=> 'Archived from <a href="%1$s">%2$s</a>',
	'MARTTIPHPBB_PRUNEACTIVEUSERS_QUICKMOD_RESTORE'	=> 'Restore from archive',
	'MARTTIPHPBB_PRUNEACTIVEUSERS_QUICKMOD_ARCHIVE'	=> 'Move to archive',
]);
