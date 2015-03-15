<?php
/**
*
* @package phpBB Extension - Fade header
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace sanfi\fadeheader\acp;

class manage_info
{
	function module()
	{
		return array(
			'filename'	=> '\sanfi\fadeheader\acp\manage_module',
			'version'	=> '1.0.5',
			'title' => 'ACP_FADE_HEADER_MANAGE',
			'modes'		=> array(
				'settings'	=> array(
					'title' => 'ACP_FADE_HEADER_MANAGE',
					'auth' => 'ext_sanfi/fadeheader && acl_a_board',
					'cat' => array('ACP_FADE_HEADER')
				),
			),
		);
	}
}
