
/**
 * Basic javascript for the Wisky skin.
 *
 * Wisky skin for MediaWiki
 *
 * @file
 * @ingroup Skins
 * @author Petr Kajzar (http://www.wikiskripta.eu/index.php/User:Slepi)
 * @license https://www.gnu.org/licenses/gpl.html GNU General Public License 3.0 or later
 */
var Wisky = {

    /**
     * Create hamburger menu
     */
    createClickableMenu: function() {

        /* basic DOM variables */

        var layout = document.getElementById("layout"),
            menu = document.getElementById("mw-navigation"),
            menuLink = document.getElementById("menuLink"),
            body = document.getElementsByTagName("body")[0];

        /* onclick hamburger menu */

        menuLink.onclick = function(e) {

            /* active class of the layout */

            var active = "active";

            /* toggle classes */

            e.preventDefault();
            Wisky.toggleClass(layout, active);

            /* menufreeze used to stop scrolling layout on smaller screens when menu opened */

            Wisky.toggleClass(body, "menufreeze");

            /* show or hide menu on the whole screen on smaller displays */

            if (window.innerWidth < 800) {
                $("#mw-navigation").css("width", "200px");
                $(".menufreeze #mw-navigation").css("width", window.innerWidth + "px");
            }
        };

    },

    /**
     * Toggle class for the element (used for active layout).
     *
     * @param {element} Which element to toggle.
     * @param {className} Which CSS class to toggle.
     */
    toggleClass: function(element, className) {

        /* watch for classes */

        var classes = element.className.split(/\s+/),
            length = classes.length,
            i = 0;

        /* if the className present, cut it away */

        for (; i < length; i++) {
            if (classes[i] === className) {
                classes.splice(i, 1);
                break;
            }
        }

        /* if the className is not found, add it */

        if (length === classes.length) {
            classes.push(className);
        }

        element.className = classes.join(" ");
    },

    /**
     * Merge notifications and create menu item
     */
    mergeNotifications: function() {
        // load messages
        $.when(mw.loader.using(["mediawiki.api.messages"]))
            .then(function() {
                // get echo message (Special:AllMessages)
                return new mw.Api().getMessages(["echo-notification-alert-text-only"]);
            })
            .then(function(message) {

                // get echo message from API result
                echomessage = message["echo-notification-alert-text-only"];

                // create menu item
                mw.util.addPortletLink("p-personal", mw.config.get("wgServer") + mw.config.get("wgScriptPath") + "/index.php?title=Special:Notifications", echomessage, "pt-new-notif", echomessage, "y", document.getElementById("pt-piskoviste"));

                // merge notifications and change menu item
                $("#pt-new-notif a").html(Number($("#pt-notifications-notice a").text()) + Number($("#pt-notifications-alert a").text()) + " " + echomessage.toLowerCase());
            });

    },

    /**
     * show menu tab home
     */
    showMenuHome: function() {

        $("#p-editmenu").hide();
        $("#p-personal").fadeIn("fast");
        $("#p-tb").fadeIn("fast");
        $("#p-navigation").fadeIn("fast");
        if (mw.config.get("wgUserName") !== null) $("#p-editorial-links").hide();
        $("#p-coll-print_export").hide();
        if ($("#p-rel-portals ul li").length > 1) $("#p-rel-portals").fadeIn("fast");
        if ($("#p-rel-exam ul li").length > 1) $("#p-rel-exam").fadeIn("fast");
        $("#p-menutab-home").css("background-color", "transparent").removeClass("inactive-menu-tab");
        $("#p-menutab-edit").css("background-color", "#c8c8c8").addClass("inactive-menu-tab");

    },

    /**
     * show menu tab edit
     */
    showMenuEdit: function() {

        $("#p-editmenu").fadeIn("fast");
        $("#p-personal").hide();
        $("#p-tb").hide();
        $("#p-navigation").hide();
        if (mw.config.get("wgUserName") !== null) $("#p-editorial-links").fadeIn("fast");
        $("#p-coll-print_export").fadeIn("fast");
        if ($("#p-rel-portals ul li").length > 1) $("#p-rel-portals").hide();
        if ($("#p-rel-exam ul li").length > 1) $("#p-rel-exam").hide();
        $("#p-menutab-edit").css("background-color", "transparent").removeClass("inactive-menu-tab");
        $("#p-menutab-home").css("background-color", "#c8c8c8").addClass("inactive-menu-tab");

    },

    /**
     * Visual Editor fix: show the edit bar under the main orange bar
     */
    showVisualBar: function() {

        if($(".oo-ui-toolbar-bar").css("right") != "auto" && $(".oo-ui-toolbar-bar").css("right") != "0px") {
            $(".oo-ui-toolbar.ve-ui-toolbar.ve-ui-dir-inline-ltr.ve-ui-dir-block-ltr.ve-ui-targetToolbar.ve-ui-positionedTargetToolbar.ve-init-mw-desktopArticleTarget-toolbar.ve-ui-toolbar-floating > .oo-ui-toolbar-bar").css("top", "3rem");
        } else {
            $(".oo-ui-toolbar-bar").css("top", "auto");
        }

    }

}

/* play that */
$(function() {

    /* create hamburger menu */
    Wisky.createClickableMenu();

    /* if logged in, show edit menu */
    if (mw.config.get("wgUserName") !== null) {
        Wisky.showMenuEdit();
    } else {
        Wisky.showMenuHome();
    }

    /* merge notifications if logged in */
    if (mw.config.get("wgUserName")) {
        Wisky.mergeNotifications();

        /* move login link if not logged in */
    } else {
        $("#pt-login").insertBefore($("#p-personal ul li:first"));
    }

});

/* show edit menu when clicking on its tab */

$("#p-menutab-home").click(function() {
    Wisky.showMenuHome();
});

/* show personal and tools menu when clicking on its tab */

$("#p-menutab-edit").click(function() {
    Wisky.showMenuEdit();
});

/* fix Visual Editor bar */

$(window).scroll(function(){Wisky.showVisualBar();});