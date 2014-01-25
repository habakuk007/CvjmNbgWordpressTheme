<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>

<!-- FlexSlider -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/js/flexslider.css" type="text/css">
<!-- FlexMenu -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/responsive-nav.css" type="text/css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tools.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.flexslider-min.js"></script>
<!-- FlexMenu -->
<script src="<?php bloginfo('template_directory'); ?>/js/responsive-nav.min.js"></script>

<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({ directionNav: false });
  });
</script>

<!-- FlexSlider end -->

</head>

<body <?php body_class(); ?>>

<div class="header">
  <img src="<?php bloginfo('template_directory'); ?>/images/logo_main.png" class="headlogo"/>
  <?php wp_nav_menu( array( 'theme_location' => 'top-short-menu',
                            'container_class' => 'header_top_menu',
                            'walker' => new Top_Menu_Walker() ));?>
  <div class="headerright searchform">
    <form role="search" method="get" id="searchform" action="/wordpress/">
    <input type="text" placeholder="Suchbegriff eingeben" size="30" name="s" id="s" class="search_field" />
    <input type="image" id="searchsubmit" src="<?php bloginfo('template_directory'); ?>/images/go_button.png" class="search_go" />
    </form>
  </div>
  <div class="headerright languages">
    Deutsch&nbsp;|&nbsp;English&nbsp;|&nbsp;Espanol
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container_class' => 'headerright nav-collapse',
                            'container'       => 'nav',
                            'menu_class'      => 'header-menu-list',
                            'walker' => new Walker_Header_Popup_Menu() ) ); ?>
  <script type="text/javascript" charset="utf-8">
    $('#menu-hauptseite-menue-oben li').hover(
      function(e) {
	    if ($(this).hasClass('menu-item-has-children')) {
          //var x = $(document).width() - e.clientX - ($(this).find('ul').width() / 2);
	      //x = $(document).width() - ($(this).offset().left + $(this).find('ul').width());
		  var x = $(this).position().left;
		  if (x < 0) {
		    x = 0;
		  }
          $(this).find('ul').css('visibility', 'visible');
		  $(this).find('ul').css('left', x);
		}
		$(this).css('background-color', '#CCCCCC');
		$(this).children('a').css('color', '#C5121D');
      },
      function() {
	    if ($(this).hasClass('menu-item-has-children')) {
          $(this).find('ul').css('visibility', 'hidden');
		  $(this).css('background-color', '#FFFFFF');
		  $(this).children('a').css('color', '#000000');
		} else if ($(this).hasClass('linelist')) {
		  $(this).css('background-color', '#FFFFFF');
		  $(this).children('a').css('color', '#000000');
		} else {
		  $(this).children('a').css('color', '#FFFFFF');
		}
      }
    );
    $('#menu-hauptseite-menue-oben li ul li a').click(
      function() {
	    if ($(this).hasClass('menu-item-has-children')) {
          //var x = $(document).width() - e.clientX - ($(this).find('ul').width() / 2);
	      //x = $(document).width() - ($(this).offset().left + $(this).find('ul').width());
		  var x = $(this).position().left;
		  if (x < 0) {
		    x = 0;
		  }
          $(this).find('ul').css('visibility', 'visible');
		  $(this).find('ul').css('left', x);
		
		  $(this).css('background-color', '#CCCCCC');
		  $(this).css('color', '#C5121D');
		}
      }
    );

	var $allVideos;
	var $fluidEl;
	
    // When the window is resized we resize all videos
    $(window).resize(function() {
      var $newWidth = $fluidEl.width();

      // Resize all videos according to their own aspect ratio
      $allVideos.each(function() {
        var $el = $(this);
        $el
          .width($newWidth)
          .height($newWidth * $el.data('aspectRatio'));
      });

    // Kick off one resize to fix all videos on page load
    });

    function event_ajax(ev) {
      overlay = '<div class="eventbox" style="width: ' + $('.eventbox').width() + 'px; line-height: ' + $('.eventbox').height() + 'px; text-align: center;">';
	  overlay += '<img src="<?php bloginfo('template_directory'); ?>/images/progress.gif" style="vertical-align: middle;">';
	  overlay += '</div>';
	  $('.eventbox').replaceWith( overlay );

      $.post(
        // URL to wordpress ajax entry point (always admin-ajax.php
        '<?php echo admin_url( 'admin-ajax.php' );?>',
        {
          // this is the name of our ajax-request as defined in functions.php
		  // and added with add_action('wp_ajax_nopriv_evtermine-ajax', ...)
          action : 'evtermine-ajax',

          // Parameters come out of the data tag in link HTML source
          count : $(this).data('count'),
          vid : $(this).data('vid'),
          query : $(this).data('query'),
		  filter : $(this).data('filter')
        },
		// We return just text
        "text"
      )
      .done( function (response) {
	    // Replace event box HTML code on the fly
        $( ".eventbox" ).replaceWith( response );
		$('.callajax').click(event_ajax);
      })
      .fail(function(xhr, textStatus, errorThrown) {
        alert( xhr.textStatus );
      });

        ev.preventDefault();
      }
	
    $(document).ready(function() {
      $("a[rel]").overlay({
        fixed: false
      });
	  
    $('.callajax').click(event_ajax);
	  
      // Embed video
      // Find all YouTube and vimeo videos
      $allVideos = $("iframe[src^='http://www.youtube.com'],iframe[src^='http://player.vimeo.com']");

      // The element that is fluid width
      $fluidEl = $(".main_container");

      // Figure out and save aspect ratio for each video
      $allVideos.each(function() {
        $(this)
          .data('aspectRatio', this.height / this.width)

          // and remove the hard coded width/height
          .removeAttr('height')
          .removeAttr('width');

      });
  
      $(window).resize();
    });

  // FlexMenu
  var navigation = responsiveNav(".nav-collapse", {
    animate: true, // Boolean: Use CSS3 transitions, true or false
    transition: 400, // Integer: Speed of the transition, in milliseconds
    label: "Menu", // String: Label for the navigation toggle
    insert: "after", // String: Insert the toggle before or after the navigation
    customToggle: "", // Selector: Specify the ID of a custom toggle
    openPos: "relative", // String: Position of the opened nav, relative or static
    navClass: "nav-collapse", // String: Default CSS class. If changed, you need to edit the CSS too!
    jsClass: "js", // String: 'JS enabled' class which is added to <html> el
    init: function(){}, // Function: Init callback
    open: function(){}, // Function: Open callback
    close: function(){} // Function: Close callback
  });

  // Entry point for reloading event list through AJAX callback
  function reload_evtermine(args)
  {
    $('.callajax').click();
  }
  
  </script>
</div>
<!--<hr class="fullseperator veryheight">-->
