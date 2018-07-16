<?php

/**
* phpBB Extension - marttiphpbb Prune Inactive Users
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\service;

use phpbb\db\driver\driver_interface as db;
use phpbb\config\config;
use phpbb\language\language;
use phpbb\user;
use phpbb\log\log;
use marttiphpbb\extrastyle\util\cnst;

class manager
{
	protected $db;
	protected $config;
	protected $language;
	protected $user;
	protected $log;
	protected $users_table;

	public function __construct(
		db $db,
		config $config,
		language $language,
		user $user,
		log $log,
		string $users_table
	)
	{
		$this->db = $db;
		$this->config = $config;
		$this->language = $language;
		$this->user = $user;
		$this->log = $log;
		$this->users_table = $users_table;
	}

	public function run()
	{
		$usernames = $user_ids = [];

		$threshold = time() - ($this->config[cnst::DAYS] * 86400);

		$sql = 'select user_id, username
			from ' . $this->users_table . '
			where user_type = ' . USER_INACTIVE . '
				and user_inactive_reason = ' . INACTIVE_REGISTER . '
				and user_regdate < ' . $threshold;
		$result = $this->db->sql_query_limit($sql, $limit, $offset);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$usernames[] = $row['username'];
			$user_ids[] = $row['user_id'];
		}
		$this->db->sql_freeresult($result);

		if (!count($user_ids))
		{
			return;
		}

		user_delete('retain', $user_ids, true);

		$this->language->add_lang('log', cnst::FOLDER);

		$this->log->add(
			'admin',
			$user->data['user_id'],
			$user->ip,
			'LOG_MARTTIPHPBB_PRUNEINACTIVEUSERS',
			false,
			[implode(', ', $usernames)]);
	}
}
