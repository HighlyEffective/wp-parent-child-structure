jQuery(document).ready(function() {

	// mobile toggle of submenu
    jQuery(".menu-toggle" ).on( "click", function() {
      jQuery("#site-navigation, html").toggleClass("toggled");
    });

   // add classes to first and last menu items in the menu's
    jQuery("#site-navigation ul.sub-menu li:first-child, #site-navigation li:first-child").addClass("first");
    jQuery("#site-navigation ul.sub-menu li:last-child, #site-navigation li:last-child").addClass("last");
    
 });
