/*
 * 	Additional function for this template
 *	Written by ThemePixels	
 *	http://themepixels.com/
 *
 *	Copyright (c) 2012 ThemePixels (http://themepixels.com)
 *	
 *	Built for Amanda Premium Responsive Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */

//jQuery.noConflict();

function openBox(url, w, h){
	url = replaceAll(url, " xandx ","&");
	tiny.box.show({iframe: url, width:w, height:h, close:false});
}

function replaceAll(Source,stringToFind,stringToReplace){		
	var temp = Source;
	if(temp == undefined) return false;
	var index = temp.indexOf(stringToFind);
	while(index != -1){
		temp = temp.replace(stringToFind,stringToReplace);
		index = temp.indexOf(stringToFind);
	}
	return temp;
}

function today_date(){
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth()+1;
    var yy = date.getYear();
    var year = (yy < 1000) ? yy + 1900 : yy;
    $('#today-date').text(day + '/' + month + '/' + year);
}

function today_hour(){
    var date = new Date();
    var curr_hour = date.getHours();
    var curr_min = date.getMinutes();
    var curr_sec = date.getSeconds();
    curr_hour = curr_hour + "";
    curr_min = curr_min + "";
    curr_sec = curr_sec + "";
    if(curr_hour.length == 1){
        curr_hour = "0" + curr_hour;
    }
    if(curr_min.length == 1){
        curr_min = "0" + curr_min;
    }
    if(curr_sec.length == 1){
        curr_sec = "0" + curr_sec;
    }
    $('#today-hour').text(curr_hour + ':' + curr_min + ':' + curr_sec);
}

jQuery(document).ready(function(){
    setInterval(today_date,500);
    setInterval(today_hour,500);
    
	jQuery('input:checkbox, input:radio, select.uniformselect').uniform();							
								
	///// SHOW/HIDE USERDATA WHEN USERINFO IS CLICKED ///// 
	
	jQuery('.userinfo').click(function(){
		if(!jQuery(this).hasClass('active')) {
			jQuery('.userinfodrop').show();
			jQuery(this).addClass('active');
		} else {
			jQuery('.userinfodrop').hide();
			jQuery(this).removeClass('active');
		}
		//remove notification box if visible
		jQuery('.notification').removeClass('active');
		jQuery('.noticontent').remove();
		
		return false;
	});
	
	
	///// SHOW/HIDE NOTIFICATION /////
	
	jQuery('.notification a').click(function(){
		var t = jQuery(this);
		var url = t.attr('href');
		if(!jQuery('.noticontent').is(':visible')) {
			jQuery.post(url,function(data){
				t.parent().append('<div class="noticontent">'+data+'</div>');
			});
			//this will hide user info drop down when visible
			jQuery('.userinfo').removeClass('active');
			jQuery('.userinfodrop').hide();
		} else {
			t.parent().removeClass('active');
			jQuery('.noticontent').hide();
		}
		return false;
	});
	
	
	
	///// SHOW/HIDE BOTH NOTIFICATION & USERINFO WHEN CLICKED OUTSIDE OF THIS ELEMENT /////


	jQuery(document).click(function(event) {
		var ud = jQuery('.userinfodrop');
		var nb = jQuery('.noticontent');
		
		//hide user drop menu when clicked outside of this element
		if(!jQuery(event.target).is('.userinfodrop') 
			&& !jQuery(event.target).is('.userdata') 
			&& ud.is(':visible')) {
				ud.hide();
				jQuery('.userinfo').removeClass('active');
		}
		
		//hide notification box when clicked outside of this element
		if(!jQuery(event.target).is('.noticontent') && nb.is(':visible')) {
			nb.remove();
			jQuery('.notification').removeClass('active');
		}
	});
	
	
	///// NOTIFICATION CONTENT /////
	
	jQuery('.notitab a').live('click', function(){
		var id = jQuery(this).attr('href');
		jQuery('.notitab li').removeClass('current'); //reset current 
		jQuery(this).parent().addClass('current');
		if(id == '#messages')
			jQuery('#activities').hide();
		else
			jQuery('#messages').hide();
			
		jQuery(id).show();
		return false;
	});
	
	
	
	///// SHOW/HIDE VERTICAL SUB MENU /////	
	
	jQuery('.vernav > ul li a, .vernav2 > ul li a').each(function(){
		var url = jQuery(this).attr('href');
		jQuery(this).click(function(){
			if(jQuery(url).length > 0) {
				if(jQuery(url).is(':visible')) {
					if(!jQuery(this).parents('div').hasClass('menucoll') &&
					   !jQuery(this).parents('div').hasClass('menucoll2'))
							jQuery(url).slideUp();
				} else {
					jQuery('.vernav ul ul, .vernav2 ul ul').each(function(){
							jQuery(this).slideUp();
					});
					if(!jQuery(this).parents('div').hasClass('menucoll') &&
					   !jQuery(this).parents('div').hasClass('menucoll2'))
							jQuery(url).slideDown();
				}
				return false;	
			}
		});
	});
	
	
	///// SHOW/HIDE SUB MENU WHEN MENU COLLAPSED /////
	jQuery('.menucoll > ul > li, .menucoll2 > ul > li').live('mouseenter mouseleave',function(e){
		if(e.type == 'mouseenter') {
			jQuery(this).addClass('hover');
			jQuery(this).find('ul').show();	
		} else {
			jQuery(this).removeClass('hover').find('ul').hide();	
		}
	});
	
	
	///// HORIZONTAL NAVIGATION (AJAX/INLINE DATA) /////	
	
	jQuery('.hornav a').click(function(){
		
		//this is only applicable when window size below 450px
		if(jQuery(this).parents('.more').length == 0)
			jQuery('.hornav li.more ul').hide();
		
		//remove current menu
		jQuery('.hornav li').each(function(){
			jQuery(this).removeClass('current');
		});
		
		jQuery(this).parent().addClass('current');	// set as current menu
		
		var url = jQuery(this).attr('href');
		if(jQuery(url).length > 0) {
			jQuery('.contentwrapper .subcontent').hide();
			jQuery(url).show();
		} else {
			jQuery.post(url, function(data){
				jQuery('#contentwrapper').html(data);
				jQuery('.stdtable input:checkbox').uniform();	//restyling checkbox
			});
		}
		return false;
	});
	
	
	///// SEARCH BOX WITH AUTOCOMPLETE /////
	/*
	var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
	jQuery('#keyword').autocomplete({
		source: availableTags
	});
	
	///// SEARCH BOX ON FOCUS /////
	
	jQuery('#keyword').bind('focusin focusout', function(e){
		var t = jQuery(this);
		if(e.type == 'focusin' && t.val() == 'Enter keyword(s)') {
			t.val('');
		} else if(e.type == 'focusout' && t.val() == '') {
			t.val('Enter keyword(s)');	
		}
	});
	*/
	
	///// NOTIFICATION CLOSE BUTTON /////
	
	jQuery('.notibar .close').click(function(){
		jQuery(this).parent().fadeOut();
	});
	
	
	///// COLLAPSED/EXPAND LEFT MENU /////
	jQuery('.togglemenu').click(function(){
		if(!jQuery(this).hasClass('togglemenu_collapsed')) {
			
			//if(jQuery('.iconmenu').hasClass('vernav')) {
			if(jQuery('.vernav').length > 0) {
				if(jQuery('.vernav').hasClass('iconmenu')) {
					jQuery('body').addClass('withmenucoll');
					jQuery('.iconmenu').addClass('menucoll');
				} else {
					jQuery('body').addClass('withmenucoll');
					jQuery('.vernav').addClass('menucoll').find('ul').hide();
				}
			} else if(jQuery('.vernav2').length > 0) {
			//} else {
				jQuery('body').addClass('withmenucoll2');
				jQuery('.iconmenu').addClass('menucoll2');
                //Jika tombol toggle menu diklik untuk membuat menu mini maka tambah cookie togglemenu2
                jQuery.cookie("togglemenu2", "collapsed", { path: '/', expires:7 });
			}
			
			jQuery(this).addClass('togglemenu_collapsed');
			
			jQuery('.iconmenu > ul > li > a').each(function(){
				var label = jQuery(this).text();
				jQuery('<li><span>'+label+'</span></li>')
					.insertBefore(jQuery(this).parent().find('ul li:first-child'));
			});
		} else {
			
			//if(jQuery('.iconmenu').hasClass('vernav')) {
			if(jQuery('.vernav').length > 0) {
				if(jQuery('.vernav').hasClass('iconmenu')) {
					jQuery('body').removeClass('withmenucoll');
					jQuery('.iconmenu').removeClass('menucoll');
				} else {
					jQuery('body').removeClass('withmenucoll');
					jQuery('.vernav').removeClass('menucoll').find('ul').show();
				}
			} else if(jQuery('.vernav2').length > 0) {	
			//} else {
				jQuery('body').removeClass('withmenucoll2');
				jQuery('.iconmenu').removeClass('menucoll2');
                //Jika tombol toggle menu diklik untuk membuat menu besar maka hapus cookie togglemenu2
                jQuery.cookie("togglemenu2", null, { path: '/', expires:7 });
			}
			jQuery(this).removeClass('togglemenu_collapsed');	
			
			jQuery('.iconmenu ul ul li:first-child').remove();
		}
	});
	
	
	
	///// RESPONSIVE /////
	if(jQuery(document).width() < 640) {
		jQuery('.togglemenu').addClass('togglemenu_collapsed');
		if(jQuery('.vernav').length > 0) {
			
			jQuery('.iconmenu').addClass('menucoll');
			jQuery('body').addClass('withmenucoll');
			jQuery('.centercontent').css({marginLeft: '56px'});
			if(jQuery('.iconmenu').length == 0) {
				jQuery('.togglemenu').removeClass('togglemenu_collapsed');
			} else {
				jQuery('.iconmenu > ul > li > a').each(function(){
					var label = jQuery(this).text();
					jQuery('<li><span>'+label+'</span></li>')
						.insertBefore(jQuery(this).parent().find('ul li:first-child'));
				});		
			}

		} else {
			
			jQuery('.iconmenu').addClass('menucoll2');
			jQuery('body').addClass('withmenucoll2');
			jQuery('.centercontent').css({marginLeft: '36px'});
			
			jQuery('.iconmenu > ul > li > a').each(function(){
				var label = jQuery(this).text();
				jQuery('<li><span>'+label+'</span></li>')
					.insertBefore(jQuery(this).parent().find('ul li:first-child'));
			});		
		}
	}
	
	
	jQuery('.searchicon').live('click',function(){
		jQuery('.searchinner').show();
	});
	
	jQuery('.searchcancel').live('click',function(){
		jQuery('.searchinner').hide();
	});
	
	
	
	///// ON LOAD WINDOW /////
	function reposSearch() {
		if(jQuery(window).width() < 520) {
			if(jQuery('.searchinner').length == 0) {
				jQuery('.search').wrapInner('<div class="searchinner"></div>');	
				jQuery('<a class="searchicon"></a>').insertBefore(jQuery('.searchinner'));
				jQuery('<a class="searchcancel"></a>').insertAfter(jQuery('.searchinner button'));
			}
		} else {
			if(jQuery('.searchinner').length > 0) {
				jQuery('.search form').unwrap();
				jQuery('.searchicon, .searchcancel').remove();
			}
		}
	}
	reposSearch();
	
	///// ON RESIZE WINDOW /////
	jQuery(window).resize(function(){
		
		if(jQuery(window).width() > 640)
			jQuery('.centercontent').removeAttr('style');
		
		reposSearch();
		
	});
	
	///// CHANGE THEME /////
	jQuery('.changetheme a').click(function(){
		var c = jQuery(this).attr('class');
		if(jQuery('#addonstyle').length == 0) {
            jQuery('head').append('<link id="addonstyle" rel="stylesheet" href="templates/css/style.'+c+'.css" type="text/css" />');
            jQuery.cookie("addonstyle", c, { path: '/', expires:7 });
		} else {
            jQuery('#addonstyle').attr('href','templates/css/style.'+c+'.css');
            jQuery.cookie("addonstyle", c, { path: '/', expires:7 });
		}
	});
    
    // TAB CUSTOM //
    jQuery('ul.tabs li').click(function(){
		var tab_id = jQuery(this).attr('data-tab');

		jQuery('ul.tabs li').removeClass('current');
		jQuery('.tab-content').removeClass('current');

		jQuery(this).addClass('current');
		jQuery("#"+tab_id).addClass('current');
	});
	
	///// LOAD ADDON STYLE WHEN IT'S ALREADY SET /////
	if(jQuery.cookie('addonstyle')) {
		var c = jQuery.cookie('addonstyle');
		if(c != '') {
			jQuery('head').append('<link id="addonstyle" rel="stylesheet" href="templates/css/style.'+c+'.css" type="text/css" />');
			jQuery.cookie("addonstyle", c, { path: '/', expires:7 });
		}
	}
	
    // LOAD MENU TOGGLE MINI JIKA ADA COOKIE TOGGLEMENU2 //
	if(jQuery.cookie('togglemenu2')) {
		jQuery('body').addClass('withmenucoll2');
		jQuery('.iconmenu').addClass('menucoll2');
        jQuery('.togglemenu').addClass('togglemenu_collapsed');
			
		jQuery('.iconmenu > ul > li > a').each(function(){
            var label = jQuery(this).text();
            jQuery('<li><span>'+label+'</span></li>')
            .insertBefore(jQuery(this).parent().find('ul li:first-child'));
		});
	}
	

});