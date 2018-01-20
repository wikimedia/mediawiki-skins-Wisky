<?php

/**
 * Wisky skin for MediaWiki
 *
 * @file
 * @ingroup Skins
 * @author Petr Kajzar
 * @copyright First Faculty of Medicine, Charles University, Prague
 * @license https://www.gnu.org/licenses/gpl.html GNU General Public License 3.0 or later
 */

class SkinWisky extends SkinTemplate {
	public $skinname = 'wisky', $stylename = 'Wisky',
		$template = 'WiskyTemplate', $useHeadElement = true;

    /**
     * Add CSS and JS
	 *
	 * @param $out OutputPage
     */
    public function initPage(OutputPage $out) {
 
		/* responsive skin: add meta tag */
        $out->addMeta('viewport', 'width=device-width, initial-scale=1.0');
 
		/* CSS styles */
        $out->addModuleStyles(array(
        	'mediawiki.skinning.interface',
        	'mediawiki.skinning.content.externallinks',
        	'skins.wisky'
        ));
       
		/* JS script */
		$out->addModules( array(
           'skins.wisky.js'
        ));
	}
    
    /**
	 * Add user CSS
	 *
	 * @param $out OutputPage
	 */
    function setupSkinUserCss(OutputPage $out) {
       parent::setupSkinUserCss($out);
    }
    
}