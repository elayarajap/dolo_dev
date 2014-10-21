// GLOBAL CLIENT INFO: values would be set in the webpage's call to Awesome
var clientID = "prototype";
var externalSiteAlert = false;
var contentsMinWidth = 160;

// TEMP CONTENTS DATA
// for now, set a contents array directly that will later be read in by a JSON call to the backend
// .type could be youtube video, modal ad or external link, so values "video" "modal" and "link"
// .thumb is a thumbnail image src
// .copy is text blurb for thumbnail caption or thumbnail text wrap
// .action is content item's initial click action, either modal contents or external link for new tab/window
// .link is the href for external links, whether directly on tray content items or wrapping modal contents (like link from video modal to youtube page)
var contentsItems = new Array();
	contentsItems[0] = new Array();
	contentsItems[0].type = "video";
	contentsItems[0].thumb = "images/tn_wie-swing_slo-mo-video.png";
	contentsItems[0].copy = "<b>MICHELLE WIE</b><br />100% Full Out Driver Swing<br />(Slo Mo) 2014";
	contentsItems[0].caption = "<b>MICHELLE WIE</b> 100% Full Out Driver Swing (Slo Mo) 2014";
	contentsItems[0].action = '<iframe width="560" height="315" src="https://www.youtube.com/embed/eU7l8mayDvw" frameborder="0" allowfullscreen></iframe>';
	contentsItems[0].link = 'https://www.youtube.com/watch?v=eU7l8mayDvw';
	contentsItems[1] = new Array();
	contentsItems[1].type = "modal";
	contentsItems[1].thumb = "images/tn_nike-lunar-empress.png";
	contentsItems[1].logo = "images/NikeLogo.png";
	contentsItems[1].copy = "NIKE LUNAR EMPRESS<br /><br />Available in 3 colors";
	contentsItems[1].action = "images/lunar-empress_modal.png";
	contentsItems[1].link = 'http://www.amazon.com/Nike-Empress-Shade-Polarized-Blue-Royal-628537-500/dp/B00EZ6ZYTM/ref=sr_1_8?ie=UTF8&qid=1406602605&sr=8-8&keywords=nike+lunar+empress';
	contentsItems[2] = new Array();
	contentsItems[2].type = "link";
	contentsItems[2].thumb = "images/tn_michelle-wie-website.png";
	contentsItems[2].copy = "<b>MICHELLE WIE</b><br />Official Website<br />http://www.michellewie.com/";
	contentsItems[2].action = "http://www.michellewie.com/";
	contentsItems[2].link = 'http://www.michellewie.com/';
	contentsItems[3] = new Array();
	contentsItems[3].type = "link";
	contentsItems[3].thumb = "images/tn_espnw-logo.png";
	contentsItems[3].copy = "<b>ESPN-W ARTICLE</b><br />Socially Speaking: LPGA's Best<br />espnW.com";
	contentsItems[3].action = "http://espn.go.com/espnw/news-commentary/article/11122103/lpga-tour-best-twitter-instagram";
	contentsItems[3].link = 'http://espn.go.com/espnw/news-commentary/article/11122103/lpga-tour-best-twitter-instagram';
	/*contentsItems[4] = new Array();
	contentsItems[4].type = "video";
	contentsItems[4].thumb = "images/tn_wie-swing_dtl-driver-video.png";
	contentsItems[4].copy = "MICHELLE WIE - BALL FLIGHT DTL DRIVER<br /> GOLF SWING LATE 2013";
	contentsItems[4].action = '<iframe width="560" height="315" src="https://www.youtube.com/embed/Ts_StRfgOwY" frameborder="0" allowfullscreen></iframe>';
	contentsItems[4].link = 'https://www.youtube.com/watch?v=Ts_StRfgOwY';*/
