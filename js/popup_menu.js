/* JavaScript code to handle the popup menu */

$(document).ready(function() {
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
});