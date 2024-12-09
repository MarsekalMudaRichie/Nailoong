/**
 * File common.js.
 *
 * @package Cerebro
 */

/**
 * navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

( function(){
	var container, button, menu, links, subMenus, i, len, body;

	body = document.getElementsByTagName( 'body' )[0];

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function(){
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			body.className = body.className.replace( ' nav-opened', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			body.className += ' nav-opened';
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

/**
 * skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */

(function(){
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function(){
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

(function($) { 'use strict';

	// Global vars

	var $window = $(window);
	var body = $('body');
	var htmlOffsetTop = parseInt($('html').css('margin-top'));
	var mainHeader = $('#masthead');
	var primaryContent = $('#primary');
	var sidebar = $('#secondary');
	var mainContent = $('#content');
	var bigSearchWrap = $('div.search-wrap');
	var bigSearchTrigger = $('#big-search-trigger');

	var w=window,d=document,
	e=d.documentElement,
	g=d.getElementsByTagName('body')[0];
	var x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

	// Checkbox and Radio buttons

	//if buttons are inside label
	function radio_checkbox_animation() {
		var checkBtn = $('label').find('input[type="checkbox"]');
		var checkLabel = checkBtn.parent('label');
		var radioBtn = $('label').find('input[type="radio"]');

		checkLabel.addClass('checkbox');

		checkLabel.click(function(){
			var $this = $(this);
			if($this.find('input').is(':checked')){
				$this.addClass('checked');
			}
			else{
				$this.removeClass('checked');
			}
		});

		var checkBtnAfter = $('label + input[type="checkbox"]');
		var checkLabelBefore = checkBtnAfter.prev('label');

		checkLabelBefore.click(function(){
			var $this = $(this);
			$this.toggleClass('checked');
		});

		radioBtn.change(function(){
			var $this = $(this);
			if($this.is(':checked')){
				$this.parent('label').siblings().removeClass('checked');
				$this.parent('label').addClass('checked');
			}
			else{
				$this.parent('label').removeClass('checked');
			}
		});
	}

	// Format Video

	function videoFormat(){
		var entryVideo = $('figure.entry-video');

		if(entryVideo.length){
			entryVideo.each(function(){
				var $this = $(this);

				$this.find('.featured-image').closest('.entry-video').addClass('has-img');
			});
		}
	}

	// Thickbox

	function videoThickbox(){
		var thickboxVideo = $('.format-video a.thickbox, .single-format-video a.thickbox');

		if(thickboxVideo.length){
			thickboxVideo.on('click touchstart', function(){
				setTimeout(function(){
					$('#TB_window').addClass('format-video');
				}, 200);
			});
		}
	}

	$(document).ready(function($){

		// Calculate clients viewport

		var x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var wScrollTop = $window.scrollTop();
		var mainHeaderHeight = mainHeader.outerHeight();
		var mainFooterHeight = $('#colophon').outerHeight();

		// Sicky Header

		if(body.hasClass('sticky-header') && x > 767){
			mainHeader.css({top: htmlOffsetTop});

			setTimeout(function(){
				mainHeaderHeight = mainHeader.outerHeight();

				if(navigator.appVersion.indexOf("MSIE 9.")!=-1){
					var mainContentPaddinigTop = parseInt($('#content').css('padding-top'), 10);
					mainContent.css({paddingTop: (mainHeaderHeight + mainContentPaddinigTop)});
				}
				else{
					mainContent.css({marginTop: (mainHeaderHeight)});
				}
			}, 200);
		}

		// Main content min-height, so footer will always be at the bottom of the page

		mainContent.css({minHeight: y - htmlOffsetTop - mainHeaderHeight - mainFooterHeight});

		// Align fixed elements with top of viewport

		var stickyHeader = $('.sticky-header #masthead');

		$([stickyHeader, sidebar, bigSearchWrap]).each(function(){
			$(this).css({top: htmlOffsetTop});
		});

		// Outline none on mousedown for focused elements

		body.on('mousedown', '*', function(e) {
			if(($(this).is(':focus') || $(this).is(e.target)) && $(this).css('outline-style') == 'none') {
				$(this).css('outline', 'none').on('blur', function(){
					$(this).off('blur').css('outline', '');
				});
			}
		});

		// Disable search submit if input empty

		$( '.search-submit' ).prop( 'disabled', true );
		$( '.search-field' ).keyup( function(){
			$('.search-submit').prop( 'disabled', this.value === "" ? true : false );
		});

		// Main Menu

		var mainNav = $('.site-header ul.nav-menu');
		var menuMarker = $('#menuMarker');

		mainNav.prepend(menuMarker);

		// dropdown button

		var mainMenuDropdownLink = $('.nav-menu .menu-item-has-children > a, .nav-menu .page_item_has_children > a');
		var dropDownArrow = $('<span class="dropdown-toggle"><span class="screen-reader-text">toggle child menu</span><i class="icon-drop-down"></i></span>');

		mainMenuDropdownLink.after(dropDownArrow);

		// dropdown open on click

		var dropDownButton = mainMenuDropdownLink.next('span.dropdown-toggle');

		dropDownButton.on('click', function(){
			var $this = $(this);
			$this.parent('li').toggleClass('toggle-on').find('.toggle-on').removeClass('toggle-on');
			$this.parent('li').siblings().removeClass('toggle-on');
		});

		// Header Bg color on scroll

		if(x > 767 && body.hasClass('sticky-header')){
			var mainHeaderOffset = 100;

			var headerOnScroll = function(){

				if(wScrollTop > mainHeaderOffset){
					body.addClass('header-scrolled');
				}
				else{
					body.removeClass('header-scrolled');
				}
			};
			headerOnScroll();

			$window.scroll(function(){
				setTimeout(function(){
					wScrollTop = $(window).scrollTop();
					headerOnScroll();
				}, 200);
			});
		}

		// Masonry call

		var masonryContainer = $('div.masonry');

		if(masonryContainer.length && x > 767){
			masonryContainer.imagesLoaded(function(){
				masonryContainer.masonry({
					columnWidth: '.grid-sizer',
					itemSelector: '.masonry > article',
					transitionDuration: 0
				}).masonry('reloadItems').masonry('layout').css({opacity: 1});

				var masonryChild = masonryContainer.children('article.hentry');

				masonryChild.each(function(i){
					setTimeout(function(){
						masonryChild.eq(i).addClass('post-loaded animate');
					}, 200 * (i+1));
				});
			});
		}

		// On Infinite Scroll Load

		var $container = $('div.grid-wrapper');

		$(document.body).on('post-load', function(){

			// Reactivate masonry on post load

			var newEl = $container.children('article').not('article.post-loaded').addClass('post-loaded');

			newEl.hide();
			newEl.imagesLoaded(function(){

				// Checkbox and Radio buttons

				radio_checkbox_animation();

				// Reactivate masonry on post load

				var $containerMasonry = $('div.masonry');

				if($containerMasonry.length && x > 767){

					$containerMasonry.masonry('appended', newEl, true).masonry('reloadItems').masonry('layout').resize();
				}

				newEl.show();

				setTimeout(function(){
					newEl.each(function(i){
						var $this = $(this);

						if($this.find('iframe').length){
							var $iframe = $this.find('iframe');
							var $iframeSrc = $iframe.attr('src');

							$iframe.load($iframeSrc, function(){
								$containerMasonry.masonry('layout');
							});
						}

						setTimeout(function(){
							newEl.eq(i).addClass('animate');
						}, 200 * (i+1));
					});
				}, 150);

				// Format Video

				videoFormat();
				wrapVideo();

				// Thickbox

				videoThickbox();

			});

		});

		// Checkbox and Radio buttons

		radio_checkbox_animation();

		// Format Video

		videoFormat();

		// Thickbox

		videoThickbox();

		// Add class .animate to non masonry elements

		var archiveEl = $('.grid-wrapper:not(.masonry) article.hentry');

		archiveEl.each(function(i){
			setTimeout(function(){
				archiveEl.eq(i).addClass('post-loaded animate');
			}, 200 * (i+1));
		});

		// Big search field

		var bigSearchField = bigSearchWrap.find('.search-field');
		var bigSearchCloseBtn = $('#big-search-close');
		var bigSearchClose = bigSearchWrap.add(bigSearchCloseBtn);

		bigSearchWrap.css({height: y - htmlOffsetTop});

		function closeSearchFn(){
			if(body.hasClass('big-search')){
				body.removeClass('big-search');
				setTimeout(function(){
					bigSearchWrap.find('.search-field').blur();
				}, 100);
			}
		}

		function closeSidebarFn(){
			if(body.hasClass('sidebar-opened')){
				body.removeClass('sidebar-opened');
				sidebarTrigg.attr('aria-expanded', 'false');
			}
		}

		bigSearchClose.on('click', function(){
			closeSearchFn();
		});

		$(document).keyup(function(e) {
			if (e.keyCode == 27) {
				closeSearchFn();
				closeSidebarFn();
			}
		});

		bigSearchTrigger.on('click', function(e){
			e.stopPropagation();
			body.addClass('big-search');
			setTimeout(function(){
				bigSearchWrap.find('.search-field').focus();
			}, 100);
		});

		bigSearchField.on('click', function(e){
			e.stopPropagation();
		});

		function getIEVersion() {
			var sAgent = window.navigator.userAgent;
			var Idx = sAgent.indexOf("MSIE");

			// If IE, return version number.
			if(Idx > 0){
				return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));
			}

			// If IE 11 then look for Updated user agent string.
			else if(!!navigator.userAgent.match(/Trident\/7\./)){
				return 11;
			}
			else{
				return 0; //It is not IE
			}
		}

		if(getIEVersion() === 9){
			var allBigSearchFields = $('.search-wrap, .not-found').find('.search-field');

			allBigSearchFields.on('keyup', function(){
				$(this).addClass('ie9-remove-bg');
			});
		}

		// Dropcaps

		var dropcap = $('span.dropcap');
		if(dropcap.length){
			dropcap.each(function(){
				var $this = $(this);
				$this.attr('data-dropcap', $this.text());
			});
		}

		// Back to top and Scroll to content

		var toTheContent = $('#scrollDown');

		if(x > 1024){
			var toTopArrow = $('#scrollUp');

			toTopArrow.on('click touchstart', function (e) {
				e.preventDefault();
				$('html, body').stop().animate({scrollTop: 0}, 800, 'swing');
				return false;
			});

			$(window).scroll(function(){
				var $this = $(this);
				if($this.scrollTop() > 600) {
					toTopArrow.addClass('show-scroll-up');
				}
				else{
					toTopArrow.removeClass('show-scroll-up');
				}
			});
		}

		if(x > 768){
			toTheContent.on('click touchstart', function (e) {
				e.preventDefault();
				$('html, body').stop().animate({scrollTop: y - htmlOffsetTop}, 800, 'swing');
				return false;
			});

			if($(window).scrollTop() > y - htmlOffsetTop) {
				toTheContent.removeClass('show-scroll-down');
			}
			else{
				toTheContent.addClass('show-scroll-down');
			}

			$(window).scroll(function(){
				var $this = $(this);

				if($this.scrollTop() > y - htmlOffsetTop) {
					toTheContent.removeClass('show-scroll-down');
				}
				else{
					toTheContent.addClass('show-scroll-down');
				}
			});
		}

		// Sidebar trigger

		var sidebarTrigg = $('#sidebar-trigger button');

		if(sidebarTrigg.length){
			var closeSidebar = body.add('#closeSidebar');

			closeSidebar.on('click touchstart', function(){
				closeSidebarFn();
			});

			sidebarTrigg.on('click touchstart', function(e){
				var $this = $(this);
				e.preventDefault();
				e.stopPropagation();
				body.toggleClass('sidebar-opened');
				body.removeClass('big-search');
				$this.blur();
				if($this.attr('aria-expanded') == 'false'){
					$this.attr('aria-expanded', 'true');
				}
				else{
					$this.attr('aria-expanded', 'false');
				}
			});

			sidebar.on('click touchstart', function(e){
				e.stopPropagation();
			});
		}

		// Contact form

		var contactForm = $('form.contact-form');

		if(contactForm.length){
			contactForm.find('input[type="text"], input[type="email"]').parent().addClass('half-width');
		}

		// Wrap .entry-video on listings

		function wrapVideo(){
			if(primaryContent.hasClass('listing')){
				primaryContent.find('figure.entry-video').each(function(){
					$(this).wrap('<div class="entry-video-wrapper"></div>');
				});
			}
		}
		wrapVideo();

		// Related Posts

		var relatedBlock = $('#jp-relatedposts');

		if(relatedBlock.length){

			if(x > 1024){
				var postNav = $('nav.post-navigation');
				relatedBlock.insertBefore(postNav);
			}

			setTimeout(function(){
				var relatedPostItems = relatedBlock.find('.jp-relatedposts-items');

				if(relatedPostItems.length === 0){
					relatedBlock.remove();
				}

				if(relatedBlock.find('h3.jp-relatedposts-headline').length){
					relatedBlock.addClass('has-headline');
				}

			}, 1000);

		}

		// Remove jetpack video wrapper if empty

		if(body.hasClass('single-post')){
			var jetpackVideoWrap = primaryContent.find('.jetpack-video-wrapper').first();
			if(jetpackVideoWrap.is(':empty') || jetpackVideoWrap.children('div').is(':empty')){
				jetpackVideoWrap.remove();
			}
		}

		// Add show class to body

		setTimeout(function(){
			body.addClass('show');
		}, 200);

	}); // End Document Ready

	// Back-forward cache fix

	$(window).on('pageshow', function(event) {
		if (event.originalEvent.persisted) {
			window.location.reload();
		}
	});

	$(window).resize(function(){

		// Calculate clients viewport

		var x=w.innerWidth||e.clientWidth||g.clientWidth, // Viewport Width
		y=w.innerHeight||e.clientHeight||g.clientHeight; // Viewport Height

		// Global Vars

		var wScrollTop = $window.scrollTop();
		var mainHeaderHeight = mainHeader.outerHeight();
		var mainFooterHeight = $('#colophon').outerHeight();

		// Main content min-height, so footer will always be at the bottom of the page

		mainContent.css({minHeight: y - htmlOffsetTop - mainHeaderHeight - mainFooterHeight});

		// Sicky Header

		if(body.hasClass('sticky-header')){
			if(x > 767){
				mainHeader.css({top: htmlOffsetTop});
				if(!(navigator.appVersion.indexOf("MSIE 9.")!=-1)){
					mainContent.css({marginTop: (mainHeaderHeight)});
				}
			}
			else{
				mainHeader.css({top: ''});
				mainContent.css({marginTop: ''});
			}
		}

		// Align fixed elements with top of viewport

		var stickyHeader = $('.sticky-header #masthead');

		$([stickyHeader, sidebar]).each(function(){
			$(this).css({top: htmlOffsetTop});
		});

		// Big search field

		bigSearchWrap.css({height: y - htmlOffsetTop});

		// Header Bg color on scroll

		if(x > 767 && body.hasClass('sticky-header')){
			var mainHeaderOffset = 100;

			var headerOnScroll = function(){

				if(wScrollTop > mainHeaderOffset){
					body.addClass('header-scrolled');
				}
				else{
					body.removeClass('header-scrolled');
				}
			};
			headerOnScroll();

			$window.scroll(function(){
				setTimeout(function(){
					wScrollTop = $(window).scrollTop();
					headerOnScroll();
				}, 200);
			});
		}

		// Related posts

		var relatedBlock = $('#jp-relatedposts');

		if(relatedBlock.length){

			if(x > 1024){
				var postNav = $('nav.post-navigation');
				relatedBlock.insertBefore(postNav);
			}
			else{
				var entryFooter = primaryContent.find('.entry-footer');
				relatedBlock.insertBefore(entryFooter);
			}

		}

		// Back to top and Scroll to content

		if(x > 768){
			var toTheContent = $('#scrollDown');

			toTheContent.on('click touchstart', function (e) {
				e.preventDefault();
				$('html, body').stop().animate({scrollTop: y - htmlOffsetTop}, 800, 'swing');
				return false;
			});

			if($(window).scrollTop() > y - htmlOffsetTop) {
				toTheContent.removeClass('show-scroll-down');
			}
			else{
				toTheContent.addClass('show-scroll-down');
			}

			$(window).scroll(function(){
				var $this = $(this);

				if($this.scrollTop() > y - htmlOffsetTop) {
					toTheContent.removeClass('show-scroll-down');
				}
				else{
					toTheContent.addClass('show-scroll-down');
				}
			});
		}

	}); // End Window Resize

	// Before Unload

	$(window).on('beforeunload', function(){

		body.removeClass('show');

	});

})(jQuery);
