(function ($, Drupal) {
  $(document).ready(function() {
    var $image = $('#background img');
    Drupal.extraModern.initializeBackground($image);

    // Re-initialize for when the image was not done loading. Chrome needs
    // this, be IE cannot work with .load(), so we need to keep the first
    // method as well.
    $image.load(function() {
      Drupal.extraModern.initializeBackground($image);
    });

    if ($('.view-carousels ul').length) {
      $('.view-carousels ul').jcarousel({
        scroll: 4
      });
    }
    if ($('.view-album-carousel ul').length) {
      $('.view-album-carousel ul').jcarousel({
        scroll: 4
      });
    }
  });

  Drupal.extraModern = Drupal.extraModern || {};

  Drupal.extraModern.initializeBackground = function($image) {
    // Options for this image.
    var FullscreenrOptions = {
      width: $image.width(),
      height: $image.height(),
      bgID: '#background img'
    };
    // Make the magic happen.
    jQuery.fn.fullscreenr(FullscreenrOptions);
  }

/**
* Fullscreenr - lightweight full screen background jquery plugin
* By Jan Schneiders
* Version 1.0
* www.nanotux.com
**/
  $.fn.fullscreenr = function(options) {
    if(options.height === undefined) alert('Please supply the background image height, default values will now be used. These may be very inaccurate.');
    if(options.width === undefined) alert('Please supply the background image width, default values will now be used. These may be very inaccurate.');
    if(options.bgID === undefined) alert('Please supply the background image ID, default #bgimg will now be used.');
    var defaults = { width: 1280, height: 1024, bgID: 'bgimg' };
    var options = $.extend({}, defaults, options);
    $(document).ready(function() { $(options.bgID).fullscreenrResizer(options); });
    $(window).bind("resize", function() { $(options.bgID).fullscreenrResizer(options); });
    return this;
  };

  $.fn.fullscreenrResizer = function(options) {
    // Set bg size
    var ratio = options.height / options.width;
    // Get browser window size
    var browserwidth = $(window).width();
    var browserheight = $(window).height();
    // Scale the image
    if ((browserheight/browserwidth) > ratio){
        $(this).height(browserheight);
        $(this).width(browserheight / ratio);
    } else {
        $(this).width(browserwidth);
        $(this).height(browserwidth * ratio);
    }
    // Center the image
    $(this).css('left', (browserwidth - $(this).width())/2);
    $(this).css('top', (browserheight - $(this).height())/2);
    return this;
  };

})(jQuery, Drupal);
