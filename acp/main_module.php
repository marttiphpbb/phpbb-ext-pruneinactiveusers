<?php
/**
* phpBB Extension - marttiphpbb pruneinactiveusers
* @copyright (c) 2018 marttiphpbb <info@martti.be>
* @license GNU General Public License, version 2 (GPL-2.0)
*/

namespace marttiphpbb\pruneinactiveusers\acp;

use marttiphpbb\pruneinactiveusers\util\cnst;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $phpbb_container;

		$request = $phpbb_container->get('request');
		$template = $phpbb_container->get('template');
		$config = $phpbb_container->get('config');
		$language = $phpbb_container->get('language');

		$language->add_lang('acp', cnst::FOLDER);
		add_form_key(cnst::FOLDER);

		switch($mode)
		{
			case 'settings':

				$this->tpl_name = 'settings';
				$this->page_title = $language->lang(cnst::L_ACP . '_SETTINGS');

				if ($request->is_set_post('submit'))
				{
					if (!check_form_key(cnst::FOLDER))
					{
						trigger_error('FORM_INVALID');
					}

					$config->set(cnst::DAYS, $request->variable('days', 0));

					trigger_error($language->lang(cnst::L_ACP . '_SETTING_SAVED') . adm_back_link($this->u_action));
				}

				$template->assign_var('DAYS', $config[cnst::DAYS]);

				break;
		}

		$template->assign_var('U_ACTION', $this->u_action);
	}
}
