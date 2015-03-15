<?php
/**
* @package Fade header
* @copyright (c) 2015 sanfi
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace sanfi\fadeheader\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',
			'core.page_header'	=> 'add_fade_header_slider',
		);
	}

	/**
	* Constructor
	*/
	public function __construct(\phpbb\template\template $template, \phpbb\db\driver\driver_interface $db, $table_prefix, $phpbb_root_path)
	{
		$this->template = $template;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->db = $db;
		$this->table_prefix = $table_prefix;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'sanfi/fadeheader',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function add_fade_header_slider($event)
	{
		define ('FADE_TABLE', $this->table_prefix.'fade_header');

		$slide = '';
		$sql = 'SELECT *
			FROM ' . FADE_TABLE . '
			ORDER BY order_img';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$last_img = '\''. $this->phpbb_root_path .'ext/sanfi/fadeheader/styles/all/theme/images/'. $row['file_name'] .'\', ';
			$slide .= $last_img;
		}
		$this->db->sql_freeresult($result);
		$this->template->assign_vars(array(
			'SLIDE'		=> substr($slide, 0, -2),
			'LAST'		=> substr($last_img, 0, -2),
		));
	}
}
