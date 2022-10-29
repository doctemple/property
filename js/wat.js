function _Get(param)
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = decodeURIComponent(hash[1]);
    }
    return vars[param];
}

(function( win ){
	var doc = win.document;
   	
	// If there's a hash, or addEventListener is undefined, stop here
	if( !location.hash && win.addEventListener ){
		//scroll to 1
		window.scrollTo( 0, 1 );
		var scrollTop = 1,
			getScrollTop = function(){
				return win.pageYOffset || doc.compatMode === "CSS1Compat" && doc.documentElement.scrollTop || doc.body.scrollTop || 0;
			},
			//reset to 0 on bodyready, if needed
			bodycheck = setInterval(function(){
				if( doc.body ){
					clearInterval( bodycheck );
					scrollTop = getScrollTop();
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
				}	
			}, 15 );
		win.addEventListener( "load", function(){
			setTimeout(function(){
					//reset to hide addr bar at onload
					win.scrollTo( 0, scrollTop === 1 ? 0 : 1 );
			}, 0);
		} );
	}
})( this );

$(document).ready(function(){

	$('#info').click(function(){
			Swal.fire({
		title: 'iCare V.1.0',
		html: "โดย<br>"+
		"เอสพี คอมพิวเตอร์<br>",
		imageUrl: 'images/logo.png',
		imageWidth: 100,
		imageHeight: 100,
		imageAlt: 'Logo',
		showConfirmButton: false,
		timer: 2500
		});
	  });

});



var page_size_check = null, q_body;
(q_body = $('body')).bind('DOMSubtreeModified', function() {
  if (page_size_check === null) {
    return;
  }
  page_size_check = setTimeout(function() {
    q_body.css('height', '');
    if (q_body.height() < window.innerHeight) {
      q_body.css('height', window.innerHeight + 'px');
    }
    if (!(window.pageYOffset > 1)) {
      window.scrollTo(0, 1);
    }
    page_size_check = null;
  }, 400);
});

$(function() {
	$('#bookmarkme').click(function() {
	  if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
		window.sidebar.addPanel(document.title, window.location.href, '');
	  } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
		window.external.AddFavorite(location.href, document.title);
	  } else if (window.opera && window.print) { // Opera Hotlist
		this.title = document.title;
		return true;
	  } else { // webkit - safari/chrome
		alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
	  }
	});
  });