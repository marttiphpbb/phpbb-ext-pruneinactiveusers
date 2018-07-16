<?php
/**
* phpBB Extension - marttiphpbb Prune Inactive Users
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\util;

class cnst
{
	const FOLDER = 'marttiphpbb/pruneinactiveusers';
	const ID = 'marttiphpbb_pruneinactiveusers';
	const PREFIX = self::ID . '_';
	const DAYS = self::ID . '_days';
	const LAST_RUN = self::ID . '_last_run';
	const L = 'MARTTIPHPBB_PRUNEINACTIVEUSERS';
	const L_ACP = 'ACP_' . self::L;
	const L_MCP = 'MCP_' . self::L;
	const TPL = '@' . self::ID . '/';
}
