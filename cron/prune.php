<?php
/**
* phpBB Extension - marttiphpbb Prune Inactive Users
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\cron;

use phpbb\cron\task\base;
use phpbb\config\config;
use marttiphpbb\pruneinactiveusers\service\manager;
use marttiphpbb\pruneinactiveusers\util\cnst;

class prune extends base
{
	protected $config;
	protected $manager;

	public function __construct(
		config $config,
		manager $manager
	)
	{
		$this->config = $config;
		$this->manager = $manager;
	}

	public function run()
	{
		$this->manager->run();
		$this->config->set(cnst::LAST_RUN, time(), false);
	}

	public function is_runnable()
	{
		return $this->config[cnst::DAYS] > 0;
	}

	public function should_run()
	{
		// every 6 hours
		return $this->config[cnst::LAST_RUN] < (time() - 21600);
	}
}
