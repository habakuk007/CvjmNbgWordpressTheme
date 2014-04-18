(function($) {
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
});

$(document).ready(function() {
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
});
})(jQuery);