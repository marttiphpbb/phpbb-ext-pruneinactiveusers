<?php

/**
* phpBB Extension - marttiphpbb Prune Inactive Users
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\service;

use phpbb\db\driver\driver_interface as db;
use phpbb\config\config;
use phpbb\user;
use phpbb\log\log;
use marttiphpbb\pruneinactiveusers\util\cnst;

class manager
{
	protected $db;
	protected $config;
	protected $user;
	protected $log;
	protected $users_table;
	protected $phpbb_root_path;

	public function __construct(
		db $db,
		config $config,
		user $user,
		log $log,
		string $users_table,
		string $phpbb_root_path
	)
	{
		$this->db = $db;
		$this->config = $config;
		$this->user = $user;
		$this->log = $log;
		$this->users_table = $users_table;
		$this->phpbb_root_path = $phpbb_root_path;
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

		if (!function_exists('user_delete'))
		{
			require_once $this->phpbb_root_path . 'includes/functions_user.php';
		}

		user_delete('retain', $user_ids, true);

		$this->log->add(
			'admin',
			$user->data['user_id'],
			$user->ip,
			'LOG_MARTTIPHPBB_PRUNEINACTIVEUSERS',
			false,
			[implode(', ', $usernames)]);
	}
}
