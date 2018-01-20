<?php
/**
 * IMPORTANT NOTICE:
 * This PHP entry point is deprecated. Please use wfLoadSkin() and the skin.json file
 * instead. See https://www.mediawiki.org/wiki/Manual:Extension_registration for more details.
 *
 * Wisky skin for MediaWiki
 *
 * @file
 * @ingroup Skins
 * @author Petr Kajzar
 * @copyright First Faculty of Medicine, Charles University, Prague
 * @license https://www.gnu.org/licenses/gpl.html GNU General Public License 3.0 or later
 */

if (!function_exists('wfLoadSkin')) {
	die('The Wisky skin requires MediaWiki 1.25 or newer.');
}

wfLoadSkin('Wisky');
