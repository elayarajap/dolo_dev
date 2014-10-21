// REDIRECT MOBILE

// GLOBAL ARRAY FOR IMAGES:  make an array to keep track of the Awesome images
var awesomeImages = new Array();

// GLOBAL CURRENT TRAY INDEX NUMBER: used to close open trays
var currentTray = -1; // tray numbering is array index 0+, so -1 indicates none open
//var trayOpening = false; // this is now a property of awesomeImages[]

// ON COMPLETE PAGE LOAD, INSERT TRAYS & CONTENTS, AND ADD MODAL DIV AT END OF PAGE
$( document ).ready( function() {
	// FIND ALL IMAGES WITH CLASS "AWESOME" IN PAGE
	// find and process each "Awesome" image: add it to images array, build its wrapper, rollover divs to close tray, tray and contents, 
	$(".awesome").each(function(index){
		// ADD IMAGE TO IMAGES ARRAY: might need src, might need styles, not sure yet exactly what we'll need and use. it's a prototype, cut me some slack.
		// we'll need the offset width/height and offset position when the wrapper div is stripped, but not stripping that off yet, not till the contents divs are getting filled.
		// not doing it. you can't make me.
		awesomeImages[index] = new Array();
		awesomeImages[index].src = $(this).attr("src");
		//awesomeImages[index].style = $(this).css();
		awesomeImages[index].offsetWidth = $(this).width();
		awesomeImages[index].offsetHeight = $(this).height();
		awesomeImages[index].trayOpen = false;
		awesomeImages[index].trayOpening = false;
		awesomeImages[index].contents = new Array();
		awesomeImages[index].contentsMinWidth = contentsMinWidth;
		awesomeImages[index].settings = $(this).data("awesome");
		
		// GET CONTENTS FOR THIS IMAGE, to know how many contents divs to create and display
		getAwesomeContents(clientID, index); // NOTE: hard coded data in contentsItems() array in global vars above

		// INSERT WRAPPER DIV WRAPPING IMG TAG
		// first get relevant styles to strip from image and apply to wrapper
		var awesomeCss = new Array();
			awesomeCss.position = $(this).css("position");
			awesomeCss.top = $(this).css("top");
			awesomeCss.left = $(this).css("left");
			awesomeCss.margin = $(this).css("margin");
			awesomeCss.marginTop = $(this).css("margin-top");
			awesomeCss.marginRight = $(this).css("margin-right");
			awesomeCss.marginBottom = $(this).css("margin-bottom");
			awesomeCss.marginLeft = $(this).css("margin-left");
			awesomeCss.float = $(this).css("float");
		
		var wrapperHTML = "";
		// start wrapper div tag with class
		wrapperHTML += '<div class="wrapper-awesome" ';
		// add ID
		wrapperHTML += 'id="wrapper-awesome-' + index + '" ';
		// add styles
		wrapperHTML += 'style="';
		wrapperHTML += 'width:' + awesomeImages[index].offsetWidth + 'px;';
		wrapperHTML += 'height:' + awesomeImages[index].offsetHeight + 'px;';
		if (awesomeCss.position != "") {
			if (awesomeCss.position != "static") {
				wrapperHTML += 'position:' + awesomeCss.position + ';';
			} else {
				wrapperHTML += 'position:relative;';
			}
			$(this).css("position","relative");
			//alert('image #' + index +' position style found: ' + awesomeCss.position);
		} else {
			//alert('image #' + index +' position style NOT found');
		}
		if (awesomeCss.top != "") {
			wrapperHTML += 'top:' + awesomeCss.top + ';';
			$(this).css("top","0px");
			//alert('image #' + index +' top style found: ' + awesomeCss.top);
		} else {
			//alert('image #' + index +' top style NOT found');
		}
		if (awesomeCss.left != "") {
			wrapperHTML += 'left:' + awesomeCss.left + ';';
			$(this).css("left","0px");
			//alert('image #' + index +' left style found: ' + awesomeCss.left);
		} else {
			//alert('image #' + index +' left style NOT found');
		}
		if (awesomeCss.margin != "") {
			wrapperHTML += 'margin:' + awesomeCss.margin + ';';
			$(this).css("margin","0px");
			//alert('image #' + index +' margin style found: ' + awesomeCss.margin);
		} else {
			//alert('image #' + index +' margin style NOT found');
		}
		if (awesomeCss.marginTop != "") {
			wrapperHTML += 'margin-top:' + awesomeCss.marginTop + ';';
			$(this).css("margin-top","0px");
			//alert('image #' + index +' margin-top style found: ' + awesomeCss.marginTop);
		} else {
			//alert('image #' + index +' margin-top style NOT found');
		}
		if (awesomeCss.marginRight != "") {
			wrapperHTML += 'margin-right:' + awesomeCss.marginRight + ';';
			$(this).css("margin-right","0px");
			//alert('image #' + index +' margin-top style found: ' + awesomeCss.marginRight);
		} else {
			//alert('image #' + index +' margin-top style NOT found');
		}
		if (awesomeCss.marginBottom != "") {
			wrapperHTML += 'margin-bottom:' + awesomeCss.marginBottom + ';';
			$(this).css("margin-bottom","0px");
			//alert('image #' + index +' margin-top style found: ' + awesomeCss.marginBottom);
		} else {
			//alert('image #' + index +' margin-top style NOT found');
		}
		if (awesomeCss.marginLeft != "") {
			wrapperHTML += 'margin-left:' + awesomeCss.marginLeft + ';';
			$(this).css("margin-left","0px");
			//alert('image #' + index +' margin-top style found: ' + awesomeCss.marginLeft);
		} else {
			//alert('image #' + index +' margin-top style NOT found');
		}
		if (awesomeCss.float != "") {
			wrapperHTML += 'float:' + awesomeCss.float + ';';
			$(this).css("float","none");
			//alert('image #' + index +' float style found: ' + awesomeCss.float);
		} else {
			//alert('image #' + index +' float style NOT found');
		}
		// close opening div tag, add closing div tag
		wrapperHTML += '">';
		wrapperHTML += '</div>'
		// wrap wrapper div around awesome image
		$(this).wrap(wrapperHTML);
		
		// ASSEMBLE TRAY & CONTENTS WITH SURROUNDING ROLLOVERS INTO VARIABLE
		var trayWithContents = "";
		
		// GET CUSTOME SETTINGS
		var trayWrapperStyles = "";
		var contentsStyles = "";
		var rgbaValue = "";
		var rValue = "";
		var gValue = "";
		var bValue = "";
		var aValue = "";
		if (awesomeImages[index].settings != undefined) {
			var awesomeSettings = awesomeImages[index].settings.replace(/; /g,';');
			awesomeImages[index].settings = awesomeSettings;
			awesomeSettings = awesomeImages[index].settings.split(";");
			for (i=0;i<awesomeSettings.length;i++) {
				if (awesomeSettings[i].charAt(":") != -1) {
					//alert('awesomeSettings[' + i + ']: ' + awesomeSettings[i]);
					var awesomeSetting = awesomeSettings[i].split(":");
					switch (awesomeSetting[0]) {
						case "bottom":
							trayWrapperStyles += "top:none; " + awesomeSettings[i] + ";";
							break;
						case "top":
							trayWrapperStyles += "bottom:none; " + awesomeSettings[i] + ";";
							break;
						case "opacity":
							aValue = awesomeSetting[1];
							if (rValue != "" && gValue != "" && bValue != "") { // rgb already set by either background or background-color
								rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
							} else {
								rgbaValue = "rgba(255,255,255," + aValue + ")"; // default bgcolor is white
							}
							break;
						case "background":
							var backgroundValues = awesomeSetting[1].split(" "); // split the values and find a color
							for (j=0;j<backgroundValues.length;j++) {
								if (backgroundValues[j].indexOf("rgba(") > -1 || backgroundValues[j].indexOf("RGBA(") > -1) { // found an rgba value
									rgbaValue = backgroundValues[j];
									var colorValues = rgbaValue.split(',');
									rValue = colorValues[0].substring(5); // remove leading 'rgba('
									gValue = colorValues[1];
									bValue = colorValues[2];
									aValue = colorValues[3].substring(0,colorValues[3].length - 1); // remove trailing ')'
									rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
								} else {
									if (backgroundValues[j].indexOf("#") > -1) { // found a hex value
										if (aValue != "") {
											rgbaValue = hex2rgb(backgroundValues[j],aValue);
										} else {
											rgbaValue = hex2rgb(backgroundValues[j],.5); // default opacity is 50%
										}
										var colorValues = rgbaValue.split(',');
										rValue = colorValues[0].substring(5); // remove leading 'rgba('
										gValue = colorValues[1];
										bValue = colorValues[2];
										aValue = colorValues[3].substring(0,colorValues[3].length - 1); // remove trailing ')'
										rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
									} 
									if (backgroundValues[j].indexOf("rgb(") > -1 || backgroundValues[j].indexOf("RGB(") > -1) { // found an rgb value
										rgbaValue = backgroundValues[j];
										var colorValues = rgbaValue.split(',');
										rValue = colorValues[0].substring(4); // remove leading 'rgb('
										gValue = colorValues[1];
										bValue = colorValues[2].substring(0,colorValues[2].length - 1); // remove trailing ')'
										if (aValue == "" ) aValue = "0.5"; // default opacity is 50%
										rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
									}
								}
							}
							break;
						case "background-color":
							if (awesomeSetting[1].indexOf("rgba(") > -1 || awesomeSetting[1].indexOf("RGBA(") > -1) { // value is already rgba
								rgbaValue = awesomeSetting[1];
								var colorValues = rgbaValue.split(',');
								rValue = colorValues[0].substring(5); // remove leading 'rgba('
								gValue = colorValues[1];
								bValue = colorValues[2];
								aValue = colorValues[3].substring(0,colorValues[3].length - 1); // remove trailing ')'
								rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
							} else {
								if (awesomeSetting[1].indexOf("#") > -1) { // '#' found so it's got a hex value to convert to RGB
									if (aValue != "") {
										rgbaValue = hex2rgb(awesomeSetting[1],aValue);
									} else {
										rgbaValue = hex2rgb(awesomeSetting[1],.5); // default opacity is 50%
									}
									var colorValues = rgbaValue.split(',');
									rValue = colorValues[0].substring(5); // remove leading 'rgba('
									gValue = colorValues[1];
									bValue = colorValues[2];
									aValue = colorValues[3].substring(0,colorValues[3].length - 1); // remove trailing ')'
									rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
								} else { // not rgba or hex, therefor rgb
									rgbaValue = awesomeSetting[1];
									var colorValues = rgbaValue.split(',');
									rValue = colorValues[0].substring(4); // remove leading 'rgb('
									gValue = colorValues[1];
									bValue = colorValues[2].substring(0,colorValues[2].length - 1); // remove trailing ')'
									if (aValue == "" ) aValue = "0.5"; // default opacity is 50%
									rgbaValue = "rgba(" + rValue + "," + gValue + "," + bValue + "," + aValue + ")";
								}
							}
							break;
						case "color":
							contentsStyles += awesomeSettings[i] + ";";
							break;
						default:
							break;
					}
				}
				if (awesomeSettings[i].charAt("=") != -1) {
					var awesomeParameter = awesomeSettings[i].split("=");
					switch (awesomeParameter[0]) {
						case "contentsMinWidth":
							awesomeImages[index].contentsMinWidth = awesomeParameter[1];
							break;
						default:
							break;
					}
				}
				//alert('awesome setting ' + i + ': ' + awesomeSettings[i]);
			}
			// if opacity, background and/or background-color were found, there is a value in rgbaValue for background
			if (rgbaValue != "") contentsStyles += "background:" + rgbaValue + ";";
		} else {
			//alert('no awesome settings found for Awesome Image #' + index);
		}

		// TRAY WRAPPER: wrapper stays locked over image, tray slides inside that
		trayWithContents += '<div class="awesome-tray-wrapper" id="awesome-tray-wrapper-' + index + '" style="height:' + (awesomeImages[index].contentsHeight + 20) + 'px; width:' + awesomeImages[index].offsetWidth + 'px;' + trayWrapperStyles + '">';
		
		// TRAY NAV OPEN
		trayWithContents += '<div class="awesome-tray-nav" id="awesome-tray-nav-' + index + '"><table><tr><td align="center" valign="middle" style="padding:0;">';
		// TRAY NAV DOTS
		for (i=0; i<awesomeImages[index].contents.length; i++) {
			trayWithContents += '<div id="tray-' + index + '-nav-' + i + '" class="tray-nav-dot"></div>';
		}
		// TRAY NAV CLOSE
		trayWithContents += '</td></tr></table></div>';
		
		// TRAY OPEN
		trayWithContents += '<div id="awesome-tray-' + index + '" class="awesome-tray" style="height:' + awesomeImages[index].contentsHeight + 'px;">';
		
		// CONTENTS DIVS: number of contents divs = number of contents items retrieved in getAwesomeContents().
		for (i=0; i<awesomeImages[index].contents.length; i++) {
			trayWithContents += '<div id="tray-' + index + '-contents-' + i + '" class="tray-contents" style="height:' + awesomeImages[index].contentsHeight + 'px; width:' + (awesomeImages[index].contentsWidth - 2) + 'px; left:' + (awesomeImages[index].contentsWidth * i) + 'px;' + contentsStyles + '"></div>';
		}
		
		// TRAY DIV CLOSE
		trayWithContents += '</div>';
		
		// ADD SCROLL LEFT/RIGHT DIVS IF MORE CONTENTS ITEMS THAN DISPLAYED
		if (awesomeImages[index].contents.length > awesomeImages[index].displayItems) {
			//alert("displayItems: " + awesomeImages[index].displayItems);
			trayWithContents += '<table id="tray-' + index + '-slider-left" class="tray-slider-left" onClick="slideTrayRight(' + index + ');" style="height:' + awesomeImages[index].contentsHeight + 'px; top:20px;"><tr><td valign="middle">&lt;</td></tr></table><table id="tray-' + index + '-slider-right" class="tray-slider-right" onClick="slideTrayLeft(' + index + ');" style="height:' + awesomeImages[index].contentsHeight + 'px; top:20px;"><tr><td valign="middle">&gt;</td></tr></table>';
		}
		
		
		// TRAY WRAPPER CLOSE
		trayWithContents += '</div>';
		
		// INSERT TRAY/CONTENTS/ROLLOVERS ASSEMBLY AFTER IMAGE TAG
		$(this).after(trayWithContents);

		// FILL NAV DOTS FOR DISPLAYED ITEMS
		for (i=0; i<awesomeImages[index].displayItems; i++) {
			//alert('nav dot: ' + '#tray-' + index + '-nav-' + i + ', background-color: ' + $('#tray-' + index + '-nav-' + i).css("backgroundColor"));
			
			$('#tray-' + index + '-nav-' + i).css('background-color','white');
		}

	});
	
	// AWESOME MODAL DIV
	// add the awesome modal div to the end of page before the closing body tag (used for contents types "video" and "modal")
	$("body").append('<div id="awesome-modal"></div>');
	
	// FILL CONTENTS
	fillAwesomeContents();
	
	// bind trayOpen and trayClose mouseover and mouseout to awesome wrappers
	$(".wrapper-awesome").on("mouseenter", function (e) {
		var idNumber = parseInt($(this).attr("id").replace("wrapper-awesome-",""));
		openTray(idNumber);
	});
	$(".wrapper-awesome").on("mouseleave", function (e) {
		var idNumber = parseInt($(this).attr("id").replace("wrapper-awesome-",""));
		closeTray(idNumber);
	});
});

function hex2rgb(hex, opacity) {
        var h=hex.replace('#', '');
        h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

        for(var i=0; i<h.length; i++)
            h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

        if (typeof opacity != 'undefined')  h.push(opacity);

        return 'rgba('+h.join(',')+')';
}

function openTray(trayNum) {
	// close any other open tray
	if (trayNum != currentTray && currentTray > -1) {
		closeTray(currentTray);
		//awesomeImages[currentTray].trayOpen = false;
	}
	currentTray = trayNum;
	/*for(i=0;i<4;i++) {
		$("#tray-closer-" + currentTray + "-" + i).show();
	}*/
	
	// only open tray if it is closed
	if (!awesomeImages[trayNum].trayOpen && !awesomeImages[trayNum].trayOpening) {
	//alert('open tray: ' + trayNum);
		awesomeImages[trayNum].trayOpening = true;
		$("#awesome-tray-nav-" + trayNum).show();
		// IF MORE CONTENT ITEMS THAN DISPLAYED, SHOW SCROLL
		if (awesomeImages[trayNum].contents.length > awesomeImages[trayNum].displayItems) {
			if (awesomeImages[trayNum].itemLeft > 0) $("#tray-" + trayNum + "-slider-left").show();
			if (awesomeImages[trayNum].itemLeft < (awesomeImages[trayNum].contents.length - awesomeImages[trayNum].displayItems)) $("#tray-" + trayNum + "-slider-right").show();
		}
		// slideDown() does not change position, it increases height from 0 to styled height. When positioned at bottom, as here, it slides up into view
		$("#awesome-tray-wrapper-" + trayNum).slideDown("slow" , function() { // stuff top do on slide complete
			awesomeImages[trayNum].trayOpen = true;
		});
	} else {
	//alert('awesomeImages[trayNum].trayOpen: ' + awesomeImages[trayNum].trayOpen + ', awesomeImages[trayNum].trayOpening: ' + awesomeImages[trayNum].trayOpening);
	}
}

function closeTray(trayNum) {
	//alert('close currentTray: ' + currentTray);
	// close any other currently open or opening tray
	if (trayNum != currentTray && (awesomeImages[currentTray].trayOpen || awesomeImages[currentTray].trayOpening)) {
		if (awesomeImages[currentTray].trayOpening) {
			$("#awesome-tray-wrapper-" + currentTray).stop(true, false);
			awesomeImages[currentTray].trayOpening = false;
		}
		$("#awesome-tray-wrapper-" + currentTray).slideUp("fast", function() {
			awesomeImages[currentTray].trayOpen = false;
			/*for(i=0;i<4;i++) {
				$("#tray-closer-" + currentTray + "-" + i).hide();
			}*/
			//currentTray = -1;
		});
	}

	// close requested tray if it is open/opening
	if (awesomeImages[trayNum].trayOpen || awesomeImages[trayNum].trayOpening) {
		if (awesomeImages[trayNum].trayOpening) {
			$("#awesome-tray-wrapper-" + trayNum).stop(true, false);
			awesomeImages[trayNum].trayOpening = false;
		}
		$("#awesome-tray-wrapper-" + trayNum).slideUp("fast", function() {
			awesomeImages[trayNum].trayOpen = false;
			for(i=0;i<4;i++) {
				$("#tray-closer-" + trayNum + "-" + i).hide();
			}
			//currentTray = -1;
		});
	}
}

function getAwesomeContents(clientID, imageNum) {
	if (clientID == "prototype") { // set each image's contents to premade array of 5 contents items, later will fill via JSON from backend
		for(i=0;i<contentsItems.length;i++) {
			awesomeImages[imageNum].contents[i] = new Array();
			awesomeImages[imageNum].contents[i].type = contentsItems[i].type;
			awesomeImages[imageNum].contents[i].thumb = contentsItems[i].thumb;
			awesomeImages[imageNum].contents[i].copy = contentsItems[i].copy;
			awesomeImages[imageNum].contents[i].action = contentsItems[i].action;
			awesomeImages[imageNum].contents[i].link = contentsItems[i].link;
			if (awesomeImages[imageNum].contents[i].type == "video") awesomeImages[imageNum].contents[i].caption = contentsItems[i].caption;
			if (awesomeImages[imageNum].contents[i].type == "modal") awesomeImages[imageNum].contents[i].logo = contentsItems[i].logo;
		}
	} else {
		// get contents from backend
	}
	
	// determine number of contents items that will fit image width
	awesomeImages[imageNum].displayItems = parseInt(awesomeImages[imageNum].offsetWidth/awesomeImages[imageNum].contentsMinWidth, 10);
	if (awesomeImages[imageNum].displayItems > awesomeImages[imageNum].contents.length) awesomeImages[imageNum].displayItems = awesomeImages[imageNum].contents.length;

	// set contents items width and height based on image size and number of display items
	awesomeImages[imageNum].contentsWidth = Math.round(awesomeImages[imageNum].offsetWidth/awesomeImages[imageNum].displayItems);
	heightDivider = Math.round(awesomeImages[imageNum].offsetHeight/177);
	awesomeImages[imageNum].contentsHeight = Math.round((awesomeImages[imageNum].offsetHeight/heightDivider));
	if (awesomeImages[imageNum].contentsHeight < 177) awesomeImages[imageNum].contentsHeight = 177;
	if (awesomeImages[imageNum].contentsHeight >200) awesomeImages[imageNum].contentsHeight = 200;
	// set contents item number for leftmost item (for sliding)
	awesomeImages[imageNum].itemLeft = 0;
}

function fillAwesomeContents() {
	for (i=0;i<awesomeImages.length;i++) { // fill tray contents for each image
		//if (awesomeImages[i].contentsMinWidth < 150) {
			//var thumbHeightVideo = Math.round(awesomeImages[i].contentsHeight * .55);
			var thumbHeightVideo = awesomeImages[i].contentsHeight;
			var thumbHeightModal = Math.round(awesomeImages[i].contentsHeight * .9);
			var thumbHeightLink = Math.round(awesomeImages[i].contentsHeight * .5);
			var thumbLeft = awesomeImages[i].contentsWidth
		/*} else {
			var thumbHeightVideo = Math.round(awesomeImages[i].contentsHeight * .65);
			var thumbHeightModal = Math.round(awesomeImages[i].contentsHeight * .9);
			var thumbHeightLink = Math.round(awesomeImages[i].contentsHeight * .8);
		}*/
		for (j=0;j<awesomeImages[i].contents.length;j++) { // for each content item of this image, insert contents
			var contentsHTML = "";
			switch (awesomeImages[i].contents[j].type) {
				case "video":
					contentsHTML += '<div class="dolo-tile" onClick="openAwesomeModal(' + i + ',' + j + ');" style="background:url(' + "'" + awesomeImages[i].contents[j].thumb + "'" + ') no-repeat center center; background-size:cover;"></div>';
					contentsHTML +='<div style="width:100%; height:40px; background:rgba(0,0,0,.8); position:absolute; bottom:0; left:0;"><p style="text-align:left; color:#fff; font-size:10px; line-height:12px; margin:0;" onClick="openAwesomeModal(' + i + ',' + j + ');">' + '<img src="images/icon_video.png" style="float:left; width:auto; height:auto; margin:6px 4px 4px;" />' + awesomeImages[i].contents[j].copy + '</p></div>';
				break;
				case "modal":
					//alert('logo: ' + awesomeImages[i].contents[j].logo);
					contentsHTML += '<div class="dolo-ad" onClick="openAwesomeModal(' + i + ',' + j + ');" style="background:url(' + "'" + awesomeImages[i].contents[j].thumb + "'" + ') no-repeat center center; background-size:cover;"></div>';
					contentsHTML +='<div onClick="openAwesomeModal(' + i + ',' + j + ');" style="width:100%; height:40px; background:rgba(255,255,255,1); position:absolute; top:0; left:0; cursor:pointer; cursor:hand;"><table style="width:100%; height:100%;" border="0"><tr><td align="center"><img src="' + awesomeImages[i].contents[j].logo + '" style="width:auto; height:auto; margin:0 auto;" /></td></tr></table></div>';
				/*if (awesomeImages[i].contentsWidth < 201) {
					contentsHTML += '<table class="awesome-tn-modal" onClick="openAwesomeModal(' + i + ',' + j + ');" style="right:none; left:4px;"><tbody><tr><td align="center" valign="middle"><div style="background-image:url(' + "'" + awesomeImages[i].contents[j].thumb + "'" + ');"></div></td></tr></tbody></table>';
					contentsHTML +='<table class="awesome-copy-modal"onClick="openAwesomeModal(' + i + ',' + j + ');"><tr><td align="left" valign="middle">' + awesomeImages[i].contents[j].copy + '</td></tr></table>';
				} else {
					contentsHTML += '<table class="awesome-tn-modal" onClick="openAwesomeModal(' + i + ',' + j + ');" style="right:none; left:20px;"><tbody><tr><td align="center" valign="middle"><div style="background-image:url(' + "'" + awesomeImages[i].contents[j].thumb + "'" + ');"></div></td></tr></tbody></table>';
					contentsHTML +='<table class="awesome-copy-modal"onClick="openAwesomeModal(' + i + ',' + j + ');" style="left:51%;"><tr><td align="left" valign="middle">' + awesomeImages[i].contents[j].copy + '</td></tr></table>';
				}*/
				break;
				case "link":
					contentsHTML += '<div class="dolo-tile" onClick="openNewWindow(' + "'" + awesomeImages[i].contents[j].link + "'" + ');" style="background:url(' + "'" + awesomeImages[i].contents[j].thumb + "'" + ') no-repeat center center; background-size:cover;"></div>';
					contentsHTML +='<div style="width:100%; height:40px; background:rgba(0,0,0,.8); position:absolute; bottom:0; left:0;"><p style="text-align:left; color:#fff; font-size:10px; line-height:12px; margin:0;" onClick="openNewWindow(' + "'" + awesomeImages[i].contents[j].link + "'" + ');">' + '<img src="images/icon_info.png" style="float:left; width:auto; height:auto; margin:6px 4px 4px;" />' + awesomeImages[i].contents[j].copy + '</p></div>';
					/*contentsHTML += '<table style="margin:0; padding:0; width:100%; height:100%;"><tbody><tr><td align="center" valign="middle">';
					contentsHTML += '<table class="awesome-tn-link" onClick="openNewWindow(' + "'" + awesomeImages[i].contents[j].link + "'" + ');" style="width:' + contentsMinWidth + 'px !important; height:' + (thumbHeightLink) + 'px;"><tbody style="width:' + contentsMinWidth + 'px !important;"><tr style="width:' + contentsMinWidth + 'px !important;"><td align="center" valign="middle" style="width:' + contentsMinWidth + 'px !important;"><img src="' + awesomeImages[i].contents[j].thumb + '" border="0" width="' + (contentsMinWidth) + '" /></td></tr></tbody></table>';
					contentsHTML +='<p class="awesome-copy-link"onClick="openNewWindow(' + "'" +awesomeImages[i].contents[j].link + "'" + ');">' + awesomeImages[i].contents[j].copy + '</p>';
					contentsHTML += '</td></tr></tbody></table>';*/
					
				break;
				default:
				contentsHTML += '<p class="awesome-tn-link" onClick="openNewWindow(' + "'" + awesomeImages[i].contents[j].link + "'" + ');"><img src="' + awesomeImages[i].contents[j].thumb + '" border="0" /></p>';
				contentsHTML +='<p class="awesome-copy-link"onClick="openNewWindow(' + "'" +awesomeImages[i].contents[j].link + "'" + ');">' + awesomeImages[i].contents[j].copy + '</p>';
				break;
			}
			$("#tray-" + i + "-contents-" + j).html(contentsHTML);
			//$("#tray-" + i + "-contents-" + j).css("background-color","rgba(255,255,255,.5)");
		}
	}
}

function openNewWindow(newURL) {
	if (externalSiteAlert) {
		var confirmMSG = 'This link opens a page from a third-party website in a new tab. ' + clientID.toUpperCase() + ' does not own or operate this third-party website and does not endorse said website, or the information, products or services contained therein. Continue?';
		if (confirm(confirmMSG)) var newWindow = window.open(newURL);
	} else {
		var newWindow = window.open(newURL);
	}
}

function openAwesomeModal(imageID, contentsID) {
	$("#awesome-modal").show();
	var awesomeContents = "";
	switch (awesomeImages[imageID].contents[contentsID].type) {
		case "video":
			awesomeContents = '<table style="width:100%; height:100%;" id="centering-table"><tr><td align="center" valign="middle"><div id="video-content-framer" style="width:560px;">' + awesomeImages[imageID].contents[contentsID].action + '<p><a href="' + awesomeImages[imageID].contents[contentsID].link + '" target="blank" style="text-decoration:none; color:#fff;">' + awesomeImages[imageID].contents[contentsID].caption + '</a></p></td></tr></table>';
			awesomeContents = '<table style="width:100%; height:100%;" id="centering-table"><tr><td align="center" valign="middle"><div id="video-content-framer" style="width:560px;">' + awesomeImages[imageID].contents[contentsID].action + '<p><a href="' + awesomeImages[imageID].contents[contentsID].link + '" target="blank" style="text-decoration:none; color:#fff;">' + awesomeImages[imageID].contents[contentsID].caption + '</a></p><div id="video-closer" onClick="closeAwesomeModal();"><table style="width:100%; height:100%;"><tr><td align="left" valign="middle"><img src="images/icons_social.png" style="margin-left:6px;" /></td><td align="right" valign="middle"><img src="images/icon_close-modal.png" style="margin-right:6px;" /></td></tr></table></div></div></td></tr></table>';
		break;
		case "modal":
			/*awesomeContents = '<table style="width:100%; height:100%;" id="centering-table"><tr><td align="center" valign="middle"><div id="modal-content-framer" style="width:400px;"><a href="' + awesomeImages[imageID].contents[contentsID].link + '" target="blank"><img id="awesome-modal" src="' + awesomeImages[imageID].contents[contentsID].action + '" border="0" /></a><div id="modal-closer" onClick="closeAwesomeModal();">X</div></div></td></tr></table>';*/
			awesomeContents = '<table style="width:100%; height:100%;" id="centering-table"><tr><td align="center" valign="middle"><div id="modal-content-framer" style="width:400px;"><img class="awesome-modal" alt="'+ awesomeImages[imageID].contents[contentsID].link + '" title="'+ awesomeImages[imageID].contents[contentsID].link + '" src="' + awesomeImages[imageID].contents[contentsID].action + '" border="0" onClick="openNewWindow(' + "'" + awesomeImages[imageID].contents[contentsID].link + "'" + ');" /><div id="modal-closer" onClick="closeAwesomeModal();">X</div></div></td></tr></table>';
		break;
	}
	//alert('attempting to display: ' + awesomeImages[imageID].contents[contentsID].action);
	$("#awesome-modal").append(awesomeContents);
	if (awesomeImages[imageID].contents[contentsID].type == "modal") {
		//alert('modal image width shown as ' + $("#awesome-modal").width());
		$("#modal-content-framer").css(width) = $("#awesome-modal").width() + "px";
	}
}

function closeAwesomeModal() {
	$("#awesome-modal").hide();
	$("#modal-content-framer").remove();
	$("#centering-table").remove();
}

function slideTrayLeft(trayID) {
	if(awesomeImages[trayID].itemLeft < (awesomeImages[trayID].contents.length - awesomeImages[trayID].displayItems)) {
		$("#tray-" + trayID + "-slider-left").show();
		$('#tray-' + trayID + '-nav-' + awesomeImages[trayID].itemLeft).css('background-color','transparent');
		awesomeImages[trayID].itemLeft = awesomeImages[trayID].itemLeft + 1;
		$('#tray-' + trayID + '-nav-' + (awesomeImages[trayID].itemLeft + awesomeImages[trayID].displayItems - 1)).css('background-color','white');

		$( "#awesome-tray-" + trayID).animate({
			left: "-=" + awesomeImages[trayID].contentsWidth,
		  }, 500, function() {
			if (awesomeImages[trayID].itemLeft == (awesomeImages[trayID].contents.length - awesomeImages[trayID].displayItems)) $("#tray-" + trayID + "-slider-right").hide();
		});
	}
}
function slideTrayRight(trayID) {
	if(awesomeImages[trayID].itemLeft > 0) {
		$("#tray-" + trayID + "-slider-right").show();
		$('#tray-' + trayID + '-nav-' + (awesomeImages[trayID].itemLeft + awesomeImages[trayID].displayItems - 1)).css('background-color','transparent');
		awesomeImages[trayID].itemLeft = awesomeImages[trayID].itemLeft - 1;
		$('#tray-' + trayID + '-nav-' + awesomeImages[trayID].itemLeft).css('background-color','white');

		$( "#awesome-tray-" + trayID).animate({
			left: "+=" + awesomeImages[trayID].contentsWidth,
		  }, 500, function() {
			if (awesomeImages[trayID].itemLeft == 0) $("#tray-" + trayID + "-slider-left").hide();
		});
	}
}
