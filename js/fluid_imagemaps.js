var $imgMaps;

// When the window is resized we resize all image maps
$(window).resize(function() {
  if (typeof $imgMaps == 'undefined') {
    return;
  }
  // This is from the resize image map jquery plugin to recalc
  // all image map links coordinates
  $imgMaps.each(function() {
	if (typeof($(this).attr('usemap')) == 'undefined')
	  return;
			
	var that = this,
	$that = $(that);
			
	// Since WebKit doesn't know the height until after the image has loaded, perform everything in an onload copy
	$('<img />').load(function() {
	  var attrW = 'width',
	  attrH = 'height',
	  w = $that.attr(attrW),
	  h = $that.attr(attrH);
				
	  if (!w || !h) {
		var temp = new Image();
		temp.src = $that.attr('src');
		if (!w)
		  w = temp.width;
		if (!h)
		  h = temp.height;
		}
				
		var wPercent = $that.width()/100,
		  hPercent = $that.height()/100,
		  map = $that.attr('usemap').replace('#', ''),
		  c = 'coords';
				
		$('map[name="' + map + '"]').find('area').each(function() {
		  var $this = $(this);
		  if (!$this.data(c))
			$this.data(c, $this.attr(c));
					
			var coords = $this.data(c).split(','),
			  coordsPercent = new Array(coords.length);
					
			for (var i = 0; i < coordsPercent.length; ++i) {
			if (i % 2 === 0)
			  coordsPercent[i] = parseInt(((coords[i]/w)*100)*wPercent);
			else
			  coordsPercent[i] = parseInt(((coords[i]/h)*100)*hPercent);
			}
			$this.attr(c, coordsPercent.toString());
		});
	 }).attr('src', $that.attr('src'));
   });
});

$(document).ready(function() {
  // Responsive image map
  $imgMaps = $('img[usemap]');
});