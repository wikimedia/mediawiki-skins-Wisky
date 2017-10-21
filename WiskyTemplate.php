<?php

/**
 * Wisky skin for MediaWiki
 * BaseTemplate class for the Wisky skin.
 *
 * @file
 * @ingroup Skins
 * @author Petr Kajzar (http://www.wikiskripta.eu/index.php/User:Slepi)
 * @license https://www.gnu.org/licenses/gpl.html GNU General Public License 3.0 or later
 */

class WiskyTemplate extends BaseTemplate {
    /**
     * Outputs a single sidebar portlet of any kind.
     */
    private function outputPortlet( $box ) {
        if ( !$box['content'] ) {
            return;
        }

        ?>
            
        <div
            role="navigation"
            class="mw-portlet"
            id="<?php echo Sanitizer::escapeId( $box['id'] ) ?>"
            <?php echo Linker::tooltip( $box['id'] ) ?>
        >
            
            <h3>
                <?php
                if ( isset( $box['headerMessage'] ) ) {
                    $this->msg( $box['headerMessage'] );
                } else {
                    echo htmlspecialchars( $box['header'] );
                }
                ?>
            </h3>

            <?php
            if ( is_array( $box['content'] ) ) {
                echo '<ul>';
                foreach ( $box['content'] as $key => $item ) {
                    echo $this->makeListItem( $key, $item );
                }
                echo '</ul>';
            } else {
                echo $box['content'];
            }?>
        </div>
        <?php
    }

    /**
     * Outputs the entire contents of the page
     */
    public function execute() {    
        $this->html( 'headelement' ); ?>
        <div id="layout">
            
            <!-- main header -->
            <div id="header_sitename" class="noprint">
                <a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>"><?php echo $this->text('sitename'); ?></a>
            </div>
            
            <!-- hamburger menu -->
            <div id="hamb-menu" class="noprint">
                <a href="#mw-navigation" id="menuLink" class="menu-link">
                    <img src="<?php echo $this->getSkin()->getSkinStylePath('resources/img/hamb.png'); ?>">
                </a>
            </div>

            <!-- navigation menu -->
            <div id="mw-navigation" class="noprint">
                
                <!-- two menu tabs: one for edits and one for personal tools -->
                <div role="navigation" class="mw-portlet" id="p-menutab">
                    
                    <!-- tab for edit menu -->
                    <div id="p-menutab-home">
                        <img src="<?php echo $this->getSkin()->getSkinStylePath('resources/img/user.png'); ?>">
                    </div>
                    
                    <!-- tab for personal and tools menu -->
                    <div id="p-menutab-edit">
                        <img src="<?php echo $this->getSkin()->getSkinStylePath('resources/img/pen.png'); ?>">
                    </div>
                </div>
                
                <!-- edit menu -->
                <div
                    role="navigation"
                    class="mw-portlet"
                    id="p-editmenu"
                >
                    
                    <!-- article tools header -->
                    <h3><?php $this->msg('mw-wisky-headline-article'); ?></h3>
                    <ul>
                    
                    <?php

                        foreach ( $this->data['content_actions'] as $key => $tab ) {
                            echo $this->makeListItem( $key, $tab );
                        }
                    ?>
                    </ul>
                </div>
                
                <!-- personal tools menu -->
                <?php

                $this->outputPortlet( array(
                    'id' => 'p-personal',
                    'headerMessage' => 'personaltools',
                    'content' => $this->getPersonalTools(),
                ) );

                foreach ( $this->getSidebar() as $boxName => $box ) {
                    $this->outputPortlet( $box );
                }

                ?>
            </div>

        <!-- main wrapper -->
        <div id="mw-wrapper">
            
            <!-- search form -->
            <form
                    action="<?php $this->text( 'wgScript' ) ?>"
                    role="search"
                    class="mw-portlet noprint"
                    id="p-search"
                >
                    <input type="hidden" name="title" value="<?php $this->text( 'searchtitle' ) ?>" />

                    <?php echo $this->makeSearchInput( array( "id" => "searchInput" ) ) ?>
                    <?php echo $this->makeSearchButton( 'image', array( 'src' => $this->getSkin()->getSkinStylePath( 'resources/img/search-ltr.png') ) ); ?>
            </form>

            <!-- main content -->
            <div class="mw-body" role="main" id="content">
                
                <!-- site notice -->
                <?php if ( $this->data['sitenotice'] ) { ?>
                    <div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
                <?php } ?>

                <!-- new discussion message at user talk page -->
                <?php if ( $this->data['newtalk'] ) { ?>
                    <div class="usermessage"><?php $this->html( 'newtalk' ) ?></div>
                <?php } ?>

                <!-- first heading -->
                <h1 id="firstHeading">
                    <?php $this->html( 'title' ) ?>
                </h1>

                <!-- subtitle -->
                <div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>

                <!-- article -->
                <div class="mw-body-content" id="bodyContent">
                    <div id="contentSub">
                        <?php if ( $this->data['subtitle'] ) { ?>
                            <p><?php $this->html( 'subtitle' ) ?></p>
                        <?php } ?>
                        <?php if ( $this->data['undelete'] ) { ?>
                            <p><?php $this->html( 'undelete' ) ?></p>
                        <?php } ?>
                    </div>

                    <?php $this->html( 'bodytext' ) ?>

                    <?php $this->html( 'catlinks' ) ?>

                    <?php $this->html( 'dataAfterContent' ); ?>

                </div>
            </div>

            <!-- footer -->
            <div id="mw-footer">
                <?php foreach ( $this->getFooterLinks() as $category => $links ) { ?>
                    <ul role="contentinfo">
                        <?php foreach ( $links as $key ) { ?>
                            <li><?php $this->html( $key ) ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <ul role="contentinfo">
                    <?php foreach ( $this->getFooterIcons( 'icononly' ) as $blockName => $footerIcons ) { ?>
                        <li>
                            <?php
                            foreach ( $footerIcons as $icon ) {
                                echo $this->getSkin()->makeFooterIcon( $icon );
                            }
                            ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        
        </div>

        <?php $this->printTrail() ?>
        </body></html>

        <?php
    }
}
