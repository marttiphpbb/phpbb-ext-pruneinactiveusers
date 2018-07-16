<?php
/**
* phpBB Extension - marttiphpbb Archive Forum
* @copyright (c) 2015 - 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\event;

use phpbb\event\data as event;
use phpbb\language\language;
use marttiphpbb\pruneinactiveusers\util\cnst;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $language;

	public function __construct(language $language)
	{
		$this->language = $language;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.get_logs_main_query_before'
				=> 'core_get_logs_main_query_before',
		];
	}

	public function core_get_logs_main_query_before(event $event)
	{
		$this->language->add_lang('log', cnst::FOLDER);
	}
}
