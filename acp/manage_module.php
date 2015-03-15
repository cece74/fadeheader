<?php
/**
*
* @package Fade header
* @copyright (c) 2015 Sheer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace sanfi\fadeheader\acp;

class manage_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $phpbb_root_path, $template, $cache, $request, $table_prefix;

		if (!defined('FADE_TABLE'))
		{
			define ('FADE_TABLE', $table_prefix.'fade_header');
		}

		$submit = $request->variable('submit', false, false, \phpbb\request\request_interface::POST);
		$upload_file = $request->file('upload_file');

		$action		= request_var('action', '');
		$img_id		= request_var('id', 0);

		$error = array();
		$max_size = 500000;
		$target_dir = '' . $phpbb_root_path . 'ext/sanfi/fadeheader/styles/all/theme/images/';

		if($submit)
		{
			$target_file = $target_dir . basename($upload_file['name']);
			$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
			if (!$upload_file['tmp_name'])
			{
				$error[] = $user->lang['NO_IMAGE'];
			}
			else
			{
				// Check if image file is a actual image or fake image
				$check = @getimagesize($upload_file['tmp_name']);
				if($check == false)
				{
					$error[] = $user->lang['IMAGE_ONLY'];
				}
				// Check if file already exists
				if (file_exists($target_file))
				{
					$error[] = $user->lang['FILE_ALREADY_EXISTS'];
				}
				// Check file size
				if ($upload_file['size'] > $max_size)
				{
					$error[] = $user->lang['FILE_TOO_LARGE'];
				}
				// Allow certain file formats
				if($file_type != 'jpg' && $file_type != 'png' && $file_type != 'jpeg' && $file_type != 'gif')
				{
					$error[] = $user->lang['ILLEGAL_FILE_TYPE'];
				}
			}

			if(!sizeof($error))
			{
				if (move_uploaded_file($upload_file['tmp_name'], $target_file))
				{
					$sql = 'SELECT MAX(order_img) AS max FROM ' . FADE_TABLE;
					$result = $db->sql_query($sql);
					$max = (int) $db->sql_fetchfield('max');
					$db->sql_freeresult($result);
					++$max;
					$sql_ary = array(
						'file_name'		=> $upload_file['name'],
						'order_img'		=> $max,
					);
					$db->sql_query('INSERT INTO ' . FADE_TABLE . ' ' . $db->sql_build_array('INSERT', $sql_ary));
					meta_refresh(3, append_sid($this->u_action));
					trigger_error(sprintf($user->lang['UPLOAD_SUCCESS'], $upload_file['name']) . adm_back_link($this->u_action));
				}
				else
				{
					meta_refresh(3, append_sid($this->u_action));
					trigger_error(sprintf($user->lang['UPLOAD_FILURE'], $upload_file['name']) . adm_back_link($this->u_action), E_USER_WARNING);
				}
			}
		}

		$this->tpl_name = 'acp_fade_header_manage_body';
		$this->page_title = $user->lang('ACP_FADE_HEADER_MANAGE');

		$sql = 'SELECT *
			FROM ' . FADE_TABLE . '
			ORDER BY order_img';
		$result = $db->sql_query($sql);
		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('images', array(
				'ID'			=> $row['id'],
				'FILE_NAME'		=> $row['file_name'],
				'U_MOVE_UP'		=> $this->u_action . '&amp;action=move_up&amp;id=' . $row['id'] . '',
				'U_MOVE_DOWN'	=> $this->u_action . '&amp;action=move_down&amp;id=' . $row['id'] . '',
				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;id=' . $row['id'] . '',
				)
			);
		}
		$db->sql_freeresult($result);

		switch ($action)
		{
			case 'move_up':
			case 'move_down':
			$move_name = $this->move($img_id, $action);
			$cache->destroy('sql', FADE_TABLE);
			if ($request->is_ajax())
			{
				$json_response = new \phpbb\json_response;
				$json_response->send(array(
					'success'	=> ($move_name !== false),
				));
			}
			break;
			case 'delete':
				if (confirm_box(true))
				{
					$sql = 'SELECT file_name
						FROM ' . FADE_TABLE . '
						WHERE id = ' . $img_id;
					$result = $db->sql_query($sql);
					$file_name = $db->sql_fetchfield('file_name');
					$db->sql_freeresult($result);

					if (@unlink('' . $target_dir . '' . $file_name . ''))
					{
						$sql = 'DELETE
							FROM ' . FADE_TABLE . '
							WHERE id = ' . $img_id;
						$db->sql_query($sql);
						meta_refresh(3, append_sid($this->u_action));
						trigger_error(sprintf($user->lang['DELETE_SUCCESS'], $file_name) . adm_back_link($this->u_action));
					}
					else
					{
						meta_refresh(3, append_sid($this->u_action));
						trigger_error($user->lang['DELETE_ERROR'] . adm_back_link($this->u_action), E_USER_WARNING);
					}
				}
				else
				{
					confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
						'id'		=> $img_id,
						'action'	=> 'delete'))
					);
				}
			break;
		}

		$template->assign_vars(array(
			'U_ACTION'		=> $this->u_action,
			'S_ERROR'		=> (sizeof($error)) ? implode('<br />', $error) : '',
		));
	}

	function move($id, $action = 'move_up')
	{
		global $db;
		$sql = 'SELECT order_img
			FROM ' . FADE_TABLE . '
			WHERE id = ' . $id;
		$result = $db->sql_query_limit($sql, 1);
		$order = $db->sql_fetchfield('order_img');
		$db->sql_freeresult($result);

		$sql = 'SELECT id, order_img
			FROM ' . FADE_TABLE . "
			WHERE " . (($action == 'move_up') ? "order_img < {$order} ORDER BY order_img DESC" : "order_img > {$order} ORDER BY order_img ASC");
		$result = $db->sql_query_limit($sql, 1);
		$target = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$target = $row;
		}
		$db->sql_freeresult($result);

		if (!sizeof($target))
		{
			return false;
		}

		if ($action == 'move_up')
		{
			$sql = 'UPDATE ' . FADE_TABLE. ' SET order_img = order_img + 1 WHERE id = '. $target['id'] . '';
			$db->sql_query($sql);
			$sql = 'UPDATE ' . FADE_TABLE. ' SET order_img = order_img - 1 WHERE id = '. $id . '';
			$db->sql_query($sql);
		}
		else
		{
			$sql = 'UPDATE ' . FADE_TABLE. ' SET order_img = order_img - 1 WHERE id = '. $target['id'] . '';
			$db->sql_query($sql);
			$sql = 'UPDATE ' . FADE_TABLE. ' SET order_img = order_img + 1 WHERE id = '. $id . '';
			$db->sql_query($sql);
		}
		return $order;
	}
}
