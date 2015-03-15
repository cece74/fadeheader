<?php
/**
*
* @package phpBB Extension - Nivo SliderFade header
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace sanfi\fadeheader\migrations;

class fade_header_1_0_5 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return;
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			'add_tables'		=> array(
				$this->table_prefix . 'fade_header'	=> array(
					'COLUMNS'			=> array(
						'id'			=> array('UINT', null, 'auto_increment'),
						'order_img'		=> array('UINT', 0),
						'file_name'		=> array('VCHAR:255', ''),
					),
					'PRIMARY_KEY'	=> 'id',
						'KEYS'	=> array(
							'file_name' 	=> array('UNIQUE', 'file_name'),
						),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'		=> array(
				$this->table_prefix . 'fade_header',
			),
		);
	}

	public function update_data()
	{
		return array(
			// Current version
			array('config.add', array('fade_header', '1.0.5')),
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_FADE_HEADER')),
			array('module.add', array('acp', 'ACP_FADE_HEADER', array(
				'module_basename'	=> '\sanfi\fadeheader\acp\manage_module',
				'module_langname'	=> 'ACP_FADE_HEADER_MANAGE',
				'module_mode'		=> 'manage',
				'module_auth'		=> 'ext_sanfi/fadeheader && acl_a_board',
			))),
		);
	}
}
