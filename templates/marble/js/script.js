/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";

	/* global google: false */

	/*-------------------------------------------------*/
	/* =  portfolio isotope
	/*-------------------------------------------------*/

	var winDow = $(window);
		// Needed variables
		var $container=$('.masonry');
		var $filter=$('.filter');

		try{
			$container.imagesLoaded( function(){
				$container.trigger('resize');
				$container.isotope({
					filter:'*',
					layoutMode:'masonry',
					animationOptions:{
						duration:750,
						easing:'linear'
					}
				});

				$('.triggerAnimation').waypoint(function() {
					var animation = $(this).attr('data-animate');
					$(this).css('opacity', '');
					$(this).addClass("animated " + animation);

				},
					{
						offset: '75%',
						triggerOnce: true
					}
				);
			});
		} catch(err) {
		}

		winDow.bind('resize', function(){
			var selector = $filter.find('a.active').attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {
			}
			return false;
		});
		
		// Isotope Filter 
		$filter.find('a').click(function(){
			var selector = $(this).attr('data-filter');

			try {
				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 750,
						easing	: 'linear',
						queue	: false,
					}
				});
			} catch(err) {

			}
			return false;
		});


	var filterItemA	= $('.filter li a');

		filterItemA.on('click', function(){
			var $this = $(this);
			if ( !$this.hasClass('active')) {
				filterItemA.removeClass('active');
				$this.addClass('active');
			}
		});

	/*-------------------------------------------------*/
	/* =  browser detect
	/*-------------------------------------------------*/
	try {
		$.browserSelector();
		// Adds window smooth scroll on chrome.
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	}
	
	/*-------------------------------------------------*/
	/* =  Animated content
	/*-------------------------------------------------*/

	try {
		/* ================ ANIMATED CONTENT ================ */
        if ($(".animated")[0]) {
            $('.animated').css('opacity', '0');
        }

        $('.triggerAnimation').waypoint(function() {
            var animation = $(this).attr('data-animate');
            $(this).css('opacity', '');
            $(this).addClass("animated " + animation);

        },
                {
                    offset: '75%',
                    triggerOnce: true
                }
        );
	} catch(err) {

	}
	
	/*-------------------------------------------------*/
	/* =  Scroll to TOP
	/*-------------------------------------------------*/

	var animateTopButton = $('.go-top'),
		htmBody = $('html, body');
		
	animateTopButton.click(function(){
	htmBody.animate({scrollTop: 0}, 'slow');
		return false;
	});

	/*-------------------------------------------------*/
	/* =  remove animation in mobile device
	/*-------------------------------------------------*/
	if ( winDow.width() < 992 ) {
		$('div.triggerAnimation').removeClass('animated');
		$('div.triggerAnimation').removeClass('triggerAnimation');
	}

	/*-------------------------------------------------*/
	/* =  Search animation
	/*-------------------------------------------------*/
	
	var searchToggle = $('.open-search'),
		inputAnime = $(".form-search"),
		body = $('body');

	searchToggle.on('click', function(event){
		event.preventDefault();

		if ( !inputAnime.hasClass('active') ) {
			inputAnime.addClass('active');
		} else {
			inputAnime.removeClass('active');			
		}
	});

	body.on('click', function(){
		inputAnime.removeClass('active');
	});

	var elemBinds = $('.open-search, .form-search');
	elemBinds.bind('click', function(e) {
		e.stopPropagation();
	});

	

	
	

	// try {
	// 	var fivecarousel = $(".five-col");
	// 	fivecarousel.owlCarousel({
	// 		navigation : true,
	// 		afterInit : function(elem){
	// 			var that = this;
	// 			that.owlControls.appendTo(elem);
	// 		},
	// 		items: 5,
	// 		itemsDesktop: [1199, 5],
	// 		itemsDesktopSmall: [979, 3],
	// 		itemsTablet: [768, 2],
	// 		itemsTabletSmall: false,
	// 		itemsMobile: [479, 1]
	// 	});
	// } catch(err) {

	// }

	/*-------------------------------------------------*/
	/* =  flexslider
	/*-------------------------------------------------*/
	try {

		var SliderPost = $('.flexslider');

		SliderPost.flexslider({
			slideshowSpeed: 3000,
			easing: "swing"
		});
	} catch(err) {

	}

	// /* ---------------------------------------------------------------------- */
	// /*	Contact Map
	// /* ---------------------------------------------------------------------- */
	// var contact = {"lat":"41.8744661", "lon":"-87.6614312"}; //Change a map coordinate here!

	// try {
	// 	var mapContainer = $('.map');
	// 	mapContainer.gmap3({
	// 		action: 'addMarker',
	// 		marker:{
	// 			options:{
	// 				icon : new google.maps.MarkerImage('../images/marker.png')
	// 			}
	// 		},
	// 		latLng: [contact.lat, contact.lon],
	// 		map:{
	// 			center: [contact.lat, contact.lon],
	// 			zoom: 15
	// 			},
	// 		},
	// 		{action: 'setOptions', args:[{scrollwheel:false}]}
	// 	);
	// } catch(err) {

	// }

	/* ---------------------------------------------------------------------- */
	/*	magnific-popup
	/* ---------------------------------------------------------------------- */

	try {
		// Example with multiple objects
		$('.zoom').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});

	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	magnific-popup
	/* ---------------------------------------------------------------------- */

	try {
		// Example with multiple objects
		$('.hover').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});

	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	Bootstrap tabs
	/* ---------------------------------------------------------------------- */
	
	var tabId = $('.nav-tabs a');
	try{		
		tabId.click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
	} catch(err) {
	}
	
	/*-------------------------------------------------*/
	/* = slider Testimonial
	/*-------------------------------------------------*/

	var slidertestimonial = $('.bxslider');
	try{		
		slidertestimonial.bxSlider({
			mode: 'horizontal'
		});
	} catch(err) {
	}

	/*-------------------------------------------------*/
	/* = skills animate
	/*-------------------------------------------------*/

	try{

		var skillBar = $('.skills-box');
		skillBar.appear(function() {

			var animateElement = $(".meter > p");
			animateElement.each(function() {
				$(this)
					.data("origWidth", $(this).width())
					.width(0)
					.animate({
						width: $(this).data("origWidth")
					}, 1200);
			});

		});
	} catch(err) {
	}

	/*-------------------------------------------------*/
	/* =  count increment
	/*-------------------------------------------------*/
	try {
		$('.statistic-post').appear(function() {
			$('.timer').countTo({
				speed: 4000,
				refreshInterval: 60,
				formatter: function (value, options) {
					return value.toFixed(options.decimals);
				}
			});
		});
	} catch(err) {

	}

	/*-------------------------------------------------*/
	/* =  parallax
	/*-------------------------------------------------*/
	
	try{
		$('.parallax').appear(function() {
			$.stellar({
				horizontalScrolling: false,
				verticalOffset: 0,
				parallaxBackgrounds: true
			});
		});
		
	} catch(err) {
	}

	/* ---------------------------------------------------------------------- */
	/*	Accordion
	/* ---------------------------------------------------------------------- */
	var clickElem = $('a.accord-link');

	clickElem.on('click', function(e){
		e.preventDefault();

		var $this = $(this),
			parentCheck = $this.parents('.accord-elem'),
			accordItems = $('.accord-elem'),
			accordContent = $('.accord-content');
			
		if( !parentCheck.hasClass('active')) {

			accordContent.slideUp(400, function(){
				accordItems.removeClass('active');
			});
			parentCheck.find('.accord-content').slideDown(400, function(){
				parentCheck.addClass('active');
			});

		} else {

			accordContent.slideUp(400, function(){
				accordItems.removeClass('active');
			});

		}
	});

	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */

	function isValidEmailAddress(emailAddress) {
		    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		    return pattern.test(emailAddress);
		};

	var submitContact = $('#submit_contact');
		

	submitContact.on('click', function(e){
		e.preventDefault();

		var message = $('#msg');

		//required:
		
		//name
		var name = $("input#name").val();
		if(name == ""){
			message.removeClass('success').removeClass('error').addClass('error').text("Name required.").fadeIn();
			
			$("input#name").focus();
			return false;
		}
		
		//email (check if entered anything)
		var email = $("input#mail").val();
		//email (check if entered anything)
		if(email == ""){
			message.removeClass('success').removeClass('error').addClass('error').fadeIn().text("Email required");
			$("input#mail").focus();
			return false;
		}
		
		//email (check if email entered is valid)

		if (email !== "") {  // If something was entered
			if (!isValidEmailAddress(email)) {
				message.removeClass('success').removeClass('error').addClass('error').fadeIn().text("Email is not valid");
				$("input#mail").focus();   //focus on email field
				return false;  
			}
		} 


		
		
		
		// comments
		var comments = $("#comment").val();
		
		if(comments == ""){
			message.removeClass('success').removeClass('error').addClass('error').fadeIn().text("Message required");
			$("#comment").focus();
			return false;
		}	


		var $this = $(this);

		var url = $this.parents('form').attr('action');
		
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			cache: false,
			data: $('#contact-form').serialize(),
			success: function(data) {

				if(data.info !== 'error'){
					$this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
					message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				} else {
					message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				}
			}
		});
	});

	/* ---------------------------------------------------------------------- */
	/*	Subscribe Form
	/* ---------------------------------------------------------------------- */

	var submitSubscribe = $('#submit-subscribe');
		

	submitSubscribe.on('click', function(e){
		e.preventDefault();

		var message = $('#subscribemsg');

		//email (check if entered anything)
		var email = $("input#e-mail").val();
		//email (check if entered anything)
		if(email == ""){
			message.removeClass('success').removeClass('error').addClass('error').fadeIn().text("Email required");
			$("input#e-mail").focus();
			return false;
		}
		
		//email (check if email entered is valid)

		if (email !== "") {  // If something was entered
			if (!isValidEmailAddress(email)) {
				message.removeClass('success').removeClass('error').addClass('error').fadeIn().text("Email is not valid");
				$("input#e-mail").focus();   //focus on email field
				return false;  
			}
		} 

		

		var $this = $(this);

		var url = $this.parents('form').attr('action');
		
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			cache: false,
			data: $('.subscribe-form').serialize(),
			success: function(data) {

				if(data.info !== 'error'){
					$this.parents('form').find('input[type=text]').filter(':visible').val('');
					message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				} else {
					message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
				}
			}
		});
	});

	function getTargetTop(elem){
		
		//gets the id of the section header
		//from the navigation's href e.g. ("#html")
		var id = elem.attr("href");

		//Height of the navigation
		var offset = 67;

		//Gets the distance from the top and 
		//subtracts the height of the nav.
		return $(id).offset().top - offset;
	}

	//Smooth scroll when user click link that starts with #

	var elemHref = $('.navbar-right a[href^="#"]');

	elemHref.click(function(event) {
		
		//gets the distance from the top of the 
		//section refenced in the href.
		var target = getTargetTop($(this));

		//scrolls to that section.
		$('html, body').animate({scrollTop:target}, 1500);

		//prevent the browser from jumping down to section.
		event.preventDefault();
	});

});