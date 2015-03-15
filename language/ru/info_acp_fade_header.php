<?php
/**
*
* Fade header [Russian]
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
	'ACP_FADE_HEADER'					=> 'Fade Header',
	'ACP_FADE_HEADER_MANAGE'			=> 'Управление',
	'ACP_FADE_HEADER_EXPLAIN'			=> 'Здесь вы можете загрузить изображения для слайдера фона шапки.',
	'UPLOAD'							=> 'Загрузить файл',
	'FILE_NAME'							=> 'Имя файла',
	'SELECT_FILE'						=> 'Загрузить файл с компьютера',
	'UPLOAD_SUCCESS'					=> 'Файл %s был успешно загружен.',
	'UPLOAD_FILURE'						=> 'Не удалось загрузить файл %s.',
	'FILE_ALREADY_EXISTS'				=> 'Извините, такой файл уже существует.',
	'FILE_TOO_LARGE'					=> 'Размер файла превышает максимально допустимый.',
	'ILLEGAL_FILE_TYPE'					=> 'Недопустимый тип файла: только файлы типов JPG, JPEG, PNG или GIF.',
	'IMAGE_ONLY'						=> 'Недопустимый MIME-тип: файл не является изображением.',
	'DELETE_SUCCESS'					=> 'Файл %s был успешно удален.',
	'DELETE_ERROR'						=> 'Не удалось удалить файл.',
	'NO_IMAGE'							=> 'Вы не выбрали файл изображения.',
));
