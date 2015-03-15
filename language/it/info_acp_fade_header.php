<?php
/**
*
* Fade header [Italian]
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
	'ACP_FADE_HEADER_MANAGE'			=> 'Gestione',
	'ACP_FADE_HEADER_EXPLAIN'			=> 'Qui è possibile caricare le immagini.',
	'UPLOAD'							=> 'Carica un file',
	'FILE_NAME'							=> 'Nome del file',
	'SELECT_FILE'						=> 'Carica un file dal tuo computer',
	'UPLOAD_SUCCESS'					=> 'File %s caricato con successo.',
	'UPLOAD_FILURE'						=> 'Impossibile caricare il file %s.',
	'FILE_ALREADY_EXISTS'				=> 'Spiacente, il file esiste già.',
	'FILE_TOO_LARGE'					=> 'La dimensione del file supera il massimo consentito.',
	'ILLEGAL_FILE_TYPE'					=> 'Tipo di file non valido, solo i file tipi JPG, JPEG, PNG o GIF.',
	'IMAGE_ONLY'						=> 'MIME-tipo: il file non è di tipo immagine.',
	'DELETE_SUCCESS'					=> 'File %s è stato rimosso con successo.',
	'DELETE_ERROR'						=> 'Impossibile eliminare il file.',
	'NO_IMAGE'							=> 'File not selected.',
));
