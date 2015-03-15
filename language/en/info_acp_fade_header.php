<?php
/**
*
* Fade header [English]
*
* @package Fade header
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_FADE_HEADER'					=> 'Fade header',
	'ACP_FADE_HEADER_MANAGE'			=> 'Management',
	'ACP_FADE_HEADER_EXPLAIN'			=> 'Here you can download the images for the header slider.',
	'UPLOAD'							=> 'Upload file',
	'FILE_NAME'							=> 'File name',
	'SELECT_FILE'						=> 'Upload a file from your computer',
	'UPLOAD_SUCCESS'					=> 'The %s has been successfully loaded.',
	'UPLOAD_FILURE'						=> 'Could not load file %s.',
	'FILE_ALREADY_EXISTS'				=> 'Sorry, the file already exists.',
	'FILE_TOO_LARGE'					=> 'File size exceeds the maximum.',
	'ILLEGAL_FILE_TYPE'					=> 'Invalid file type, only files types JPG, JPEG, PNG or GIF.',
	'IMAGE_ONLY'						=> 'Illegal type: file is not an image.',
	'DELETE_SUCCESS'					=> 'File %s was removed successfully.',
	'DELETE_ERROR'						=> 'Failed to delete file.',
	'NO_IMAGE'							=> 'File not selected.',
));
