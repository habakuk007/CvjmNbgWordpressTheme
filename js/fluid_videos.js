(function($) {
var $allObjects;
var $fluidEl;

// When the window is resized we resize all videos
$(window).resize(function() {
  var $newWidth = $fluidEl.width();

  // Resize all videos according to their own aspect ratio
  $allObjects.each(function() {
	var $el = $(this);
	$el
	  .width($newWidth)
	  .height($newWidth * $el.data('aspectRatio'));
  });
});

$(document).ready(function() {
  // Embed video and objects
  // Find all YouTube and vimeo videos and issuu pdfs
  $allObjects = $("iframe[src^='//www.youtube.com'],iframe[src^='//player.vimeo.com'],div[data-url^='//issuu.com'],.issuuembed");

  // The element that is fluid width
  $fluidEl = $(".main_container");

  // Figure out and save aspect ratio for each video
  $allObjects.each(function() {
	$(this)
	  .data('aspectRatio', this.scrollHeight / this.scrollWidth)

	  // and remove the hard coded width/height
	  .removeAttr('height')
	  .removeAttr('width');

  });
});
})(jQuery);