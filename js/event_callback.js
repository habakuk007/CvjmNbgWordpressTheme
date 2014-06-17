(function($) {
function event_ajax(ev) {
  overlay = '<div class="eventbox" style="width: ' + $('.eventbox').width() + 'px; line-height: ' + $('.eventbox').height() + 'px; text-align: center;">';
  overlay += '<img src="' + params.template_path + '/images/progress.gif" style="vertical-align: middle;">';
  overlay += '</div>';
  $('.eventbox').replaceWith( overlay );

  $.post(
	// URL to wordpress ajax entry point (always admin-ajax.php
	params.admin_url,
	{
	  // this is the name of our ajax-request as defined in functions.php
	  // and added with add_action('wp_ajax_nopriv_evtermine-ajax', ...)
	  action : 'evtermine-ajax',

	  // Parameters come out of the data tag in link HTML source
	  count : $(this).data('count'),
	  vid : $(this).data('vid'),
	  query : $(this).data('query'),
	  filter : $(this).data('filter'),
    headline: $(this).data('headline')
	},
	// We return just text
	"text"
  )
  .done( function (response) {
	// Replace event box HTML code on the fly
	$( ".eventbox" ).replaceWith( response );
	$('.callajax').click(event_ajax);
	$("a.evtermine_title").overlay({
	  fixed: false
	});
  })
  .fail(function(xhr, textStatus, errorThrown) {
	alert( xhr.textStatus );
  });

  ev.preventDefault();
}

// Entry point for reloading event list through AJAX callback
function reload_evtermine(args)
{
$('.callajax').click();
}

$(document).ready(function() {
  $("a.evtermine_title").overlay({
	  fixed: false
  });
  
  $('.callajax').click(event_ajax);
});
})(jQuery);