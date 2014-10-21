<?php 
header("Content-type: text/css; charset=utf-8");

$fD = htmlspecialchars($_GET['fd']);
$cS = '#'.htmlspecialchars($_GET['cs']);
$cS2 = '#'.htmlspecialchars($_GET['cs2']);
$hTC = '#'.htmlspecialchars($_GET['htc']);
$tC1 = '#'.htmlspecialchars($_GET['tc1']);
$tC2 = '#'.htmlspecialchars($_GET['tc2']);
$wC = '#'.htmlspecialchars($_GET['wc']);
$bC = '#'.htmlspecialchars($_GET['bc']);
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; 
}

$hTCRGB = 'rgba('.implode(",", hex2rgb($hTC)).', 0.5)';
?>
/*-------------------------------------------------
 =  Table of Css

 1.Isotope
 2.Header
 3.content - home sections
 4.Home2
 5.Home3
 6.Portfolio pages
 7.Blog pages
 8.Single Post
 9.single-project
 10.About
 11.Services
 12.Contact
 13.Error
 14.testimonials page
 15.Faqs page
 16.shortcodes
 17.Footer
 18.Responsive Part
-------------------------------------------------*/

/*-------------------------------------------------------*/
/* 1. Isotope filtering
/*-------------------------------------------------------*/
.isotope-item {
    z-index: 2;
}
.isotope-hidden.isotope-item {
    pointer-events: none;
    z-index: 1;
}
.isotope, .isotope .isotope-item {/* change duration value to whatever you like */
    -webkit-transition-duration: 0.8s;
    -moz-transition-duration: 0.8s;
    transition-duration: 0.8s;
}
.isotope {
    -webkit-transition-property: height, width;
    -moz-transition-property: height, width;
    transition-property: height, width;
}
.isotope .isotope-item {
    -webkit-transition-property: -webkit-transform, opacity;
    -moz-transition-property:-moz-transform, opacity;
    transition-property:transform, opacity;
}

/*-------------------------------------------------*/
/* =  import variables.less file
/*-------------------------------------------------*/
/*@import "variables";*/


/* the default font in our template*/
@font: '<?php echo $fD;?>', sans-serif;

/* default color skin */
@skin-color: <?php echo $cS;?>;

/* default color skin 2 */
@skin-color2: <?php echo $cS2;?>;

/* background grey, headings text color*/
@skin-color3: <?php echo $hTC;?>;

/* background skin with transparency*/
@background2: <?php echo $hTCRGB;?>;

/* text color 1 (some titles and some subtitles contain this color)*/
@color1: <?php echo $tC1;?>; 

/* text color 2 (some text paragraphcs)*/
@color2: <?php echo $tC2;?>;

/* white color*/
@white: <?php echo $wC;?>;

/* black color*/
@black: <?php echo $bC;?>;

/* ul reset margin and padding*/
.ul-reset {
    margin: 0;
    padding: 0;
}

/* default style for paragraphs in this template*/
.paragraph {
    font-size: 13px;
    color: @color1;
    font-family: @font;
    font-weight: 400;
    line-height: 20px;
    margin: 0 0 24px;
}

/* default style for anchors in this template*/
.anchor {
    display: inline-block;
    text-decoration: none;
    .transition;
}

/* default style for hading1 in this template*/
.heading1 {
    color: @skin-color3;
    font-size: 24px;
    font-family: @font;
    font-weight: 700;
    margin: 0 0 7px;
}

/* default style for hading2 in this template*/
.heading2 {
    color: @skin-color3;
    font-size: 14px;
    font-family: @font;
    font-weight: 700;
    margin: 0 0 2px;
    text-transform: uppercase;
}

/* default style for hading3 in this template*/
.heading3 {
    color: @white;
    font-size: 18px;
    font-family: @font;
    font-weight: 700;
    margin: 0 0 16px;
}

/* default style for hading4 in this template*/
.heading4 {
    color: @color2 - #202020;
    font-size: 16px;
    font-family: @font;
    text-transform: uppercase;
    line-height: 25px;
    margin: 0 0 10px;
}

/* variable for radius corners*/
.radius(@radius) { 
    -webkit-border-radius: @radius;
    -moz-border-radius: @radius;
    -o-border-radius: @radius;
    border-radius: @radius;
}

/* variable for radius corners*/
.radius-bottom-left(@radius) { 
    -webkit-border-bottom-left-radius: @radius;
    -moz-border-bottom-left-radius: @radius;
    -o-border-bottom-left-radius: @radius;
    border-bottom-left-radius: @radius;
}

/* variable for radius corners*/
.radius-bottom-right(@radius) { 
    -webkit-border-bottom-right-radius: @radius;
    -moz-border-bottom-right-radius: @radius;
    -o-border-bottom-right-radius: @radius;
    border-bottom-right-radius: @radius;
}

/* variable for radius corners*/
.radius-top-left(@radius) {
    -webkit-border-top-left-radius: @radius;
    -moz-border-top-left-radius: @radius;
    -o-border-top-left-radius: @radius;
    border-top-left-radius: @radius;
}

/* variable for radius corners*/
.radius-top-right(@radius) { 
    -webkit-border-top-right-radius: @radius;
    -moz-border-top-right-radius: @radius;
    -o-border-top-right-radius: @radius;
    border-top-right-radius: @radius;
}

/* variable for transitions*/
.transition { 
    transition: all 0.20s ease-in-out;
    -moz-transition: all 0.20s ease-in-out;
    -webkit-transition: all 0.20s ease-in-out;
    -o-transition: all 0.20s ease-in-out;
}

/* variable for transitions*/
.transition2 { 
    transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
}

/* variable for tranform grow elem scale*/
.grow-transform(@scale) { 
    transform: scale(@scale);
    -webkit-transform: scale(@scale);
    -moz-transform: scale(@scale);
    -o-transform: scale(@scale);
}

/* no shadow  variable*/
.no-shadow {
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -o-box-shadow: none;
}

/* box shadow  variable*/
.box-shadow(@val) {
    box-shadow: @val;
    -webkit-box-shadow: @val;
    -moz-box-shadow: @val;
    -o-box-shadow: @val;
}

/* animation duration  variable*/
.animation-hover {
    -webkit-animation-fill-mode:both;
    -moz-animation-fill-mode:both;
    -ms-animation-fill-mode:both;
    -o-animation-fill-mode:both;
    animation-fill-mode:both;
    -webkit-animation-duration:1s;
    -moz-animation-duration:1s;
    -ms-animation-duration:1s;
    -o-animation-duration:1s;
    animation-duration:1s;
    -webkit-animation-name: hovertrans;
    -moz-animation-name: hovertrans;
    -ms-animation-name: hovertrans;
    -o-animation-name: hovertrans;
    animation-name: hovertrans;
}

/* animate transform variable*/
.animate-transform {
    @-webkit-keyframes hovertrans {
        0% { .grow-transform(0); }    
        50% { .grow-transform(1.07); }
        100% { .grow-transform(1); }
    }
    @-moz-keyframes hovertrans {
        0% { .grow-transform(0); }    
        50% { .grow-transform(1.07); }
        100% { .grow-transform(1); }
    }
    @-o-keyframes hovertrans {
        0% { .grow-transform(0); }    
        50% { .grow-transform(1.07); }
        100% { .grow-transform(1); }
    }
    @keyframes hovertrans {
        0% { .grow-transform(0); }    
        50% { .grow-transform(1.07); }
        100% { .grow-transform(1); }
    }
}

/* animate transform rotate variable*/
.rotate(@rotate) {
    -webkit-transform: rotate(@rotate);
    -moz-transform: rotate(@rotate);
    -ms-transform: rotate(@rotate);
    -o-transform: rotate(@rotate);
    transform: rotate(@rotate);
}

/* animate transform rotate x variable*/
.rotateX(@rotate) {
    -webkit-transform: rotateX(@rotate);
    -moz-transform: rotateX(@rotate);
    -ms-transform: rotateX(@rotate);
    -o-transform: rotateX(@rotate);
    transform: rotateX(@rotate);
}

/* animate transform rotate Y variable*/
.rotateY(@rotate) {
    -webkit-transform: rotateY(@rotate);
    -moz-transform: rotateY(@rotate);
    -ms-transform: rotateY(@rotate);
    -o-transform: rotateY(@rotate);
    transform: rotateY(@rotate);
}

/* animate transform rotate Y variable*/
.trans-origin {
    -webkit-transform-origin: 0 0;
    -moz-transform-origin: 0 0;
    -ms-transform-origin: 0 0;
    -o-transform-origin: 0 0;
    transform-origin: 0 0;
}

/*-------------------------------------------------*/
/* =  Header
/*-------------------------------------------------*/

.navbar-default {
    background: #f9fafb;
    border: none;
}

.navbar-brand {
    height: auto;
    padding: 18px 15px;
}

.navbar-nav {
    margin-top: 10px;
    > li {
        margin-left: 20px;
    }
    > li > a {
        color: #333;
        font-size: 14px;
        font-family: @font;
        font-weight: 700;
        text-transform: uppercase;
        .transition;
        padding-bottom: 22px;
    }
    > li > a:hover {
        color: @skin-color !important;
    }
    a.open-search {
        padding-left: 0;
        i {
            color: @skin-color;
            font-size: 20px;
            display: inline-block;
            margin-top: -5px;
        }
    }
    li.drop {
        position: relative;
    }
    li ul.drop-down {
        .ul-reset;
        position: absolute;
        top: 100%;
        left: 0;
        width: 160px;
        visibility: hidden;
        opacity: 0;
        z-index: 3;
        text-align: left;
        .transition;
        .trans-origin;
        .rotateX(-90deg);
        li {
            list-style: none;
            display: block;
            margin: 0;
            ul.drop-down.level3 {
                .rotateX(0deg);
                .rotateY(-90deg);
                top: 0px;
                left: 100%;
                border-bottom: none;
            }
            a {
                .anchor;
                display: block;
                color: @white;
                font-size: 12px;
                font-family: @font;
                padding: 16px 20px;
                text-transform: uppercase;
                font-weight: 700;
                background: @skin-color3;
                margin: 0;
                border: none;
            }
            a:hover {
                background: @skin-color;
            }
        }
        li:hover {
            ul.drop-down.level3 {
                .rotateY(0deg);
            }
        }
        li:last-child {
            border-bottom: none;
        }
    }

    li:hover > ul.drop-down {
        visibility: visible;
        opacity: 1;
        .rotateX(0deg);
    }
}

header.one-page {
    .navbar-nav > li {
        margin-left: 0;
    }
    .navbar-nav > li > a span {
        color: @skin-color;
    }
}

.form-search {
    position: absolute;
    top: 100%;
    right: 0;
    width: 230px;
    background: @skin-color;
    padding: 14px;
    visibility: hidden;
    opacity: 0;
    .rotateX(-90deg);
    .transition;
    input[type="search"] {
        .paragraph;
        margin: 0;
        color: @skin-color3;
        padding: 10px 12px;
        border: none;
        width: 100%;
        outline: none;
        .transition;
        background: @white;
    }
    button {
        background: @white;
        border: none;
        float: right;
        margin-top: -32px;
        margin-right: 15px;
        position: relative;
        z-index: 2;
    }
    button i {
        color: @skin-color;
        font-size: 16px;
    }
}

.form-search.active {
    visibility: visible;
    opacity: 1;
    .rotateX(0deg);
} 

/*-------------------------------------------------*/
/* =  content - home sections
/*-------------------------------------------------*/
#container {
    padding-top: 67px;
}

.slider1 {
    position: relative;
    .banner-thumbs {
        position: absolute;
        z-index: 999;
        width: 100%;
        height: 100px;
        left: 0;
        bottom: 50px;
        ul.slider-thumbnails {
            .ul-reset;
            overflow: hidden;
            li {
                border-top: 2px solid @skin-color3;
                margin: 0;
                width: 25%;
                .transition;
                float: left;
                a {
                    .anchor;
                    .radius(0px);
                    background: @skin-color3;
                    display: block;
                    border: none !important;
                    margin: 0;
                    width: 100%;
                    padding: 30px 10px;
                    overflow: hidden;
                    span {
                        display: inline-block;
                        float: left;
                        width: 40px;
                        height: 40px;
                        .radius(50%);
                        background: @skin-color;
                        color: @white;
                        text-align: center;
                        line-height: 40px;
                        font-size: 18px;
                        font-family: arial;
                        font-weight: 700;
                        .transition;
                    }
                    h2 {
                        .heading2;
                        color: @white;
                        font-size: 18px;
                        text-transform: inherit;
                        margin: 3px 0 0 60px;
                        .transition;
                        text-align: left;
                    }
                    p {
                        .paragraph;
                        font-size: 12px;
                        font-weight: 700;
                        margin: 0;
                        margin-left: 60px;
                        .transition;
                        text-align: left;
                    }
                }
                a:hover {
                    background: @skin-color3;
                    opacity: 0.7;
                }
            }
            li.active {
                border-top: 2px solid @skin-color;
                a {
                    span {
                        background: @white;
                        color: @skin-color3;
                    }
                }
            }
        }
    }
}

.slider1 {
    overflow: hidden;
}

.slider1 .tp-bannertimer {
    display: none;
}

.slotholder:after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(58, 61, 65, 0.8);
}

.slider3 .slotholder:after {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
}

.tp-caption.large_bold_white {
    font-size: 60px;
    font-family: @font;
    font-weight: 700;
}

.tp-caption.medium_thin_white {
    color: @white;
    font-size: 18px;
    font-family: @font;
}

.tp-caption.medium_thin_white .button-large {
    margin: 0 10px;
}

.tp-caption.large_bold_grey {
    font-size: 60px;
    color: @skin-color3;
    font-weight: 700;
    text-align: center;
    span {
        color: @skin-color;
        display: block;
    }
}

.tp-caption.medium_thin_grey {
    color: @color2;
    font-size: 18px;
    font-family: @font;
    text-align: center;
}

.slider3 .tp-leftarrow.default {
    background:url(../images/revolution-icons/large_left2.png) no-Repeat 0 0;
}

.slider3 .tp-rightarrow.default {
    background:url(../images/revolution-icons/large_right2.png) no-Repeat 0 0;
}

.slider3 .tp-leftarrow:hover,
.slider3 .tp-rightarrow:hover {   background-position:bottom left; }

.slider-fullwidth {
    margin-top: -67px;
}

.title-section {
    padding: 64px 56px;
    text-align: center;
    background: #f9fafb;
    h1 {
        .heading1;
    }
    p {
        .paragraph;
        color: @color2;
        font-size: 18px;
        margin: 0;
    }
}

.services-section {
    .services-box {
        background: url('../../../images/parallax/back.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding: 60px 0;
        position: relative;
        .services-post {
            margin-bottom: 25px;
            text-align: center;
            position: relative;
            z-index: 2;
            .services-head {
                position: relative;
                padding-bottom: 15px;
                margin-bottom: 30px;
                a {
                    .anchor;
                    width: 60px;
                    height: 60px;
                    background: #f9fafb;
                    .radius(50%);
                    margin-bottom: 22px;
                    i {
                        color: @skin-color3;
                        line-height: 60px;
                        font-size: 30px;
                        .transition;
                    }
                }
                h2 {
                    .heading1;
                    color: @white;
                    margin-bottom: 3px;
                }
                span {
                    .paragraph;
                    display: inline-block;
                    font-size: 12px;
                    color: @white;
                    margin: 0;
                }
            }
            .services-head:after {
                position: absolute;
                content: '';
                width: 60px;
                height: 1px;
                background: @white;
                bottom: 0;
                left: 50%;
                margin-left: -30px;
                .transition;
            }
            p {
                .paragraph;
            }
        }
        .services-post:hover {
            .services-head {
                a {
                    background: @skin-color;
                    i {
                        color: @white;
                    }
                }
            }
            .services-head:after {
                background: @skin-color;
            }
        }
    }
    .services-box:after {
        position: absolute;
        content: '';
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(58, 61, 65, 0.8);
    }
}

a.button-one {
    .anchor;
    padding: 10px 15px;
    color: @white;
    font-size: 12px;
    font-family: @font;
    font-weight: 700;
    text-transform: uppercase;
    .radius(3px);
    border: 1px solid @color2;
    .box-shadow(0 3px 0 #5c5f62);
}

a.button-one:hover {
    background: @skin-color;
    border: 1px solid @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
}

.banner-section {
    background: url('../../../images/bg/pattern.png');
    padding: 60px 0;
    text-align: center;
    h1 {
        .heading1;
        color: @white;
        margin-bottom: 16px;
    }
    p {
        .paragraph;
        color: @color2;
        font-size: 14px;
    }
}

a.button-two {
    .anchor;
    background: @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
    .radius(3px);
    span {
        display: inline-block;
        padding: 10px 26px 9px;
        color: @white;
        font-size: 12px;
        font-family: @font;
        font-weight: 700;
        text-transform: uppercase;
        .transition;
    }
    i {
        padding: 12px 15px;
        font-size: 14px;
        color: @white;
        border-left: 1px solid @skin-color2;
        .transition;
    }
}

a.button-two:hover {
    background: #f9fafb;
    .box-shadow(0 3px 0 #808080);
    span {
        color: @skin-color;
    }
    i {
        color: @skin-color;
        border-left: 1px solid #d9dadb;
        background: #f3f4f5;
    }
}

.portfolio-box {
    .project-post {
        text-align: center;
        .project-gal {
            position: relative;
            img {
                width: 100%;
            }
            .hover-box {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                background: rgba(255, 255, 255, 0.65);
                .transition;
                visibility: hidden;
                opacity: 0;
                a {
                    .anchor;
                    width: 40px;
                    height: 40px;
                    text-align: center;
                    .radius(50%);
                    background: @skin-color;
                    top: 50%;
                    margin-top: -20px;
                    position: absolute;
                    .rotate(360deg);
                    .transition2;
                    i {
                        font-size: 14px;
                        color: @white;
                        line-height: 40px;
                    }
                }
                a:hover {
                    background: @skin-color3;
                }
                a.zoom {
                    right: 50%;
                    margin-right: 35px;
                }
                a.link {
                    left: 50%;
                    margin-left: 35px;
                }
            }
        }
        .project-content {
            padding: 25px 10px;
            background: #f9fafb;
            border-bottom: 1px solid transparent;
            h2 {
                .heading2;
            }
            p {
                .paragraph;
                margin-bottom: 0;
                font-size: 12px;
                color: @color2;
            }
        }
    }
    .project-post:hover {
        .project-gal {
            .hover-box {
                visibility: visible;
                opacity: 1;
                a {
                    .rotate(0);
                }
                a.zoom {
                    margin-right: 5px;
                }
                a.link {
                    margin-left: 5px;
                }
            }
        }
        .project-content {
            border-bottom: 1px solid @skin-color;
            background: @white;
        }
    }
}

div.buttons {
    text-align: center;
    margin: 50px 0;
    a.button-third {
        margin: 0 8px;
    }
}

a.button-third {
    .anchor;
    padding: 10px 15px;
    color: @color2;
    font-size: 12px;
    font-family: @font;
    font-weight: 700;
    text-transform: uppercase;
    .radius(3px);
    border: 1px solid #e5e5e5;
    .box-shadow(0 3px 0 #e5e5e5);
    margin: 0;
    i {
        font-size: 12px;
    }
}
a.button-third:hover {
    border: 1px solid @color2;
}

.owl-pagination {
    display: none;
}

.owl-theme .owl-controls {
    display: none !important;
}

.features-section {
    background: url('../../../images/parallax/back2.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
    .container {
        position: relative;
        z-index: 3;
        .features-head {
            margin-bottom: 75px;
            text-align: center;
            h1 {
            .heading1;
            color: @white;
            margin-bottom: 16px;
            }
            p {
                .paragraph;
                color: @color2;
                font-size: 14px;
            }
        }
        .feature-list {
            padding: 0;
            margin: 0 0 30px;
            li {
                list-style: none;
                span {
                    display: inline-block;
                    float: left;
                    width: 40px;
                    height: 40px;
                    .radius(50%);
                    border: 2px solid @white;
                    text-align: center;
                    i {
                        color: @white;
                        font-size: 18px;
                        line-height: 40px;
                    }
                }
                .list-cont {
                    margin-left: 54px;
                    padding-top: 10px;
                    h3 {
                        .heading3;
                    }
                    p {
                        .paragraph;
                        color: @color2;
                    }
                }
            }
        }
        .image-place {
            text-align: center;
            position: relative;
            img {
                max-width: 100%;
                margin-bottom: -40px;
            }
        }
    }
}
.features-section:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(58, 61, 65, 0.8);
}
.features-section:before {
    position: absolute;
    content: '';
    width: 100%;
    height: 60px;
    bottom: 0;
    left: 0;
    background: #f9fafb;
    z-index: 2;
}

.blog-section {
    .title-section {
        background: @white;
    }
    .blog-post {
        margin: 0 10px;
        img {
            width: 100%;
        }
        .post-content {
            overflow: hidden;
            .post-date {
                float: left;
                width: 60px;
                height: 90px;
                background: @skin-color3;
                text-align: center;
                padding: 12px 2px;
                .transition;
                p {
                    .paragraph;
                    margin: 0;
                    color: @white;
                    font-size: 14px;
                    line-height: 30px;
                    span {
                        display: block;
                        position: relative;
                        font-size: 24px;
                        font-weight: 700;
                        line-height: 38px;
                    }
                    span:after {
                        position: absolute;
                        content: '';
                        width: 20px;
                        height: 1px;
                        background: @white;
                        bottom: 0px;
                        left: 50%;
                        margin-left: -10px;
                    }
                }
            }
            .content-data {
                margin-left: 60px;
                padding: 15px 20px;
                background: #f9fafb;
                min-height: 90px;
                h2 {
                    .heading2;
                    line-height: 20px;
                    margin: 0;
                    a {
                        color: @skin-color3;
                        .anchor;
                        text-decoration: none;
                    }
                    a:hover {
                        color: @skin-color;
                    }
                }
                p {
                    .paragraph;
                    color: @color2;
                    font-size: 12px;
                    margin: 0;
                    a {
                        .anchor;
                        color: @color2;
                    }
                }
            }
        }
    }
    .blog-post:hover {
        .post-date {
            background: @skin-color;
        }
    }
}

.client-section {
    background: #f9fafb;
    padding-bottom: 60px;
    overflow: hidden;
    ul.client-list {
        padding: 0;
        margin: 0;
        overflow: hidden;
        li {
            list-style: none;
            float: left;
            width: 16.666%;
            a {
                width: 100%;
                .anchor;
                img {
                    width: 100%;
                }
            }
            a:hover {
                opacity: 0.7;
            }
        }
    }
    .bx-wrapper .bx-pager {
        display: none;
    }
    .bx-wrapper .bx-controls-direction a {
        .anchor;
        top: 0;
        width: 40px;
        height: 40px;
        color: @color2;
        font-size: 12px;
        font-family: @font;
        font-weight: 700;
        text-transform: uppercase;
        .radius(3px);
        border: 1px solid #e5e5e5;
        .box-shadow(0 3px 0 #e5e5e5);
        margin: 0 8px;
        position: absolute;
        margin-top:10px;
        background: @white;
    }
    .bx-wrapper .bx-controls-direction a.bx-prev {
        margin-left: -40px;
    }
    .bx-wrapper .bx-controls-direction a.bx-next {
        margin-right: -40px;
    }
    .bx-wrapper .bx-controls-direction a.bx-prev:before {
        font-family: 'FontAwesome';
        content: "\f104";
        position: absolute;
        font-size: 12px;
        color: @color2;
        width: 100%;
        left: 0;
        top: 0;
        text-align: center;
        line-height: 40px;
        -webkit-backface-visibility: hidden;
    }
    .bx-wrapper .bx-controls-direction a.bx-next:before {
        font-family: 'FontAwesome';
        content: "\f105";
        position: absolute;
        font-size: 12px;
        color: @color2;
        width: 100%;
        left: 0;
        top: 0;
        text-align: center;
        line-height: 40px;
        -webkit-backface-visibility: hidden;
    }
    .bx-wrapper .bx-controls-direction a:hover {
        border: 1px solid @color2;
    }
}

/*-------------------------------------------------*/
/* =  Home2
/*-------------------------------------------------*/

.features-section2 {
    overflow: hidden;
    .title-section {
        background: @white;
    }
    .features-box {
        background: url('../../../images/parallax/back3.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        padding: 40px 0 0px;
        position: relative;
        .container {
            position: relative;
            z-index: 2;
        }
    }
    .features-box:after {
        position: absolute;
        content: '';
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.92);
    }
    .image-place {
        margin-top: 10px;
        text-align: center;
        position: relative;
        z-index: 2;
        img {
            max-width: 100%;
            margin: 0;
        }
    }
}

.feature-list2 {
    padding: 0;
    margin: 0 0 30px;
    li {
        list-style: none;
        span {
            display: inline-block;
            float: left;
            width: 40px;
            height: 40px;
            .radius(50%);
            background: @skin-color;
            text-align: center;
            i {
                color: @white;
                font-size: 18px;
                line-height: 40px;
            }
        }
        .list-cont {
            margin-left: 54px;
            padding-top: 10px;
            h3 {
                .heading3;
                color: @skin-color3;
            }
            p {
                .paragraph;
                color: @color2;
            }
        }
    }
}

.feature-list2.white {
    padding: 0;
    margin: 0 0 30px;
    li {
        list-style: none;
        span {
            display: inline-block;
            float: left;
            width: 40px;
            height: 40px;
            .radius(50%);
            background: transparent;
            border: 2px solid @white;
            text-align: center;
            i {
                color: @white;
                font-size: 18px;
                line-height: 40px;
            }
        }
        .list-cont {
            margin-left: 54px;
            padding-top: 10px;
            h3 {
                .heading3;
                color: @white;
            }
            p {
                .paragraph;
                color: @color2;
            }
        }
    }
}

.statistic-section {
    background: url('../../../images/parallax/back.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    position: relative;
    padding: 60px 0 70px;
    .container {
        position: relative;
        z-index: 2;
    }
}

.statistic-post {
    overflow: hidden;
    i {
        float: left;
        font-size: 30px;
        color: @skin-color;
        display: inline-block;
        margin-top: 30px;
    }
    p {
        .paragraph;
        margin: 0;
        margin-left: 46px;
        font-size: 18px;
        line-height: 24px;
        font-weight: 700;
        color: @white;
        span {
            color: @white;
            font-size: 48px;
            line-height: 54px;
        }
    }
}

.statistic-section:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(58, 61, 65, 0.8);
}

.portfolio-box.portfolio-style2 {
    .project-post {
        .project-gal {
            .hover-box {
                background: rgba(255, 255, 255, 0.9);
                .inner-hover {
                    position: absolute;
                    top: 50%;
                    margin-top: -35px;
                    width: 100%;
                    left: 0;
                    h2 {
                        .heading2;
                        color: @skin-color;
                    }
                    p {
                        .paragraph;
                        margin-bottom: 0;
                        font-size: 12px;
                        color: @color2;
                    }
                    a {
                        position: relative;
                        top: inherit;
                        margin-bottom: 16px;
                    }
                    a.zoom {
                        right: inherit;
                        margin-right: 40;
                    }
                    a.link {
                        left: inherit;
                        margin-left: 40;
                    }
                }
            }
        }
    }
    .project-post:hover {
        .project-gal {
            .hover-box {
                .inner-hover {
                    a.zomm {
                        margin-right: 5px;
                    }
                    a.link {
                        margin-left: 5px;
                    }
                }
            }
        }
    }
}

.title-section.transparent-back {
    background: transparent;
    h1 {
        color: @white;
    }
}

.testimonials-section {
    background: url('../../../images/parallax/back6.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    position: relative;
    padding: 0px 0 40px;
    .container {
        position: relative;
        z-index: 2;
    }
    .title-section {
        position: relative;
        z-index: 2;
    }

    .bx-wrapper .bx-pager.bx-default-pager a {
        background: transparent;
        border: 2px solid @white;
    }

    .bx-wrapper .bx-pager.bx-default-pager a:hover,
    .bx-wrapper .bx-pager.bx-default-pager a.active {
        background: @skin-color;
        border: 2px solid @skin-color;
    }
}

.testimonials-section:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(58, 61, 65, 0.8);
}

.testimonial-post {
    text-align: center;
    margin-bottom: 20px;
    img {
        display: inline-block;
        max-width: 60px;
        .radius(50%);
        margin-bottom: 12px;
    }
    h2 {
        .heading2;
        color: @white;
        margin-bottom: 27px;
    }
    p {
        .paragraph;
        color: @white;
        max-width: 860px;
        margin: 0 auto;
        padding: 20px 25px;
        background: @skin-color;
        position: relative;
        .radius(9px);
    }
    p:after {
        position: absolute;
        content: '';
        width: 20px;
        height: 20px;
        background: @skin-color;
        border: 1px solid @skin-color;
        left: 50%;
        margin-left: -10px;
        top: -10px;
        .rotate(45deg);
    }
}

/*-------------------------------------------------*/
/* =  home 3
/*-------------------------------------------------*/

.banner-section.style2 {
    background: @white;
    h1 {
        .heading1;
    }
    p {
        .paragraph;
        color: @color2;
        font-size: 14px;
    }
}

.portfolio-box.portfolio-style2.hover-second {
    .project-post {
        .project-gal {
            .hover-box {
                background: rgba(58, 61, 65, 0.9);
            }
        }
    }
}

.title-section.pattern {
    background: url('../../../images/bg/pattern.png');
    h1 {
        color: @white;
    }
}

.features-section3 {
    background: url('../../../images/parallax/back3.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    padding: 55px 0 50px;
    position: relative;
    .container {
        position: relative;
        z-index: 2;
        h1 {
            .heading1;
            line-height: 28px;
            color: @skin-color;
            span {
                color: @skin-color3;
            }
        }
        p {
            .paragraph;
            color: @color2;
            margin-bottom: 45px;
        }
        .image-place {
            img {
                max-width: 100%;
                margin: 0;
            }
        }
    }
}

.feature-list3 {
    padding: 0;
    margin: 0 0 30px;
    li {
        list-style: none;
        span {
            display: inline-block;
            float: left;
            width: 60px;
            height: 60px;
            .radius(50%);
            background: @skin-color3;
            text-align: center;
            i {
                color: @white;
                font-size: 24px;
                line-height: 60px;
            }
        }
        .list-cont {
            margin-left: 74px;
            h3 {
                .heading3;
                color: @skin-color3;
                font-size: 24px;
                margin-bottom: 5px;
            }
            p {
                .paragraph;
                color: @color2;
                font-size: 14px;
            }
        }
    }
}

.features-section3:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.92);
}

.blog-section.second-style {
    .blog-post {
        overflow: hidden;
        .post-gal {
            margin-left: 60px;
        }
        .post-content > p {
            .paragraph;
            padding: 16px 22px;
            margin: 0;
            margin-left: 60px;
            color: @color2;
        }
        .post-date {
            float: left;
            width: 60px;
            height: 90px;
            background: @skin-color3;
            text-align: center;
            padding: 12px 2px;
            .transition;
            p {
                .paragraph;
                margin: 0;
                color: @white;
                font-size: 14px;
                line-height: 30px;
                span {
                    display: block;
                    position: relative;
                    font-size: 24px;
                    font-weight: 700;
                    line-height: 38px;
                }
                span:after {
                    position: absolute;
                    content: '';
                    width: 20px;
                    height: 1px;
                    background: @white;
                    bottom: 0px;
                    left: 50%;
                    margin-left: -10px;
                }
            }
        }
    }
    .blog-post:hover {
        .post-date {
            background: @skin-color;
        }
    }
}

/*-------------------------------------------------*/
/* =  portfolio pages
/*-------------------------------------------------*/
.page-banner {
    padding: 42px 0 47px;
    position: relative;
    .container {
        position: relative;
        z-index: 2;
        h1 {
            .heading1;
            color: @white;
            font-size: 36px;
        }
    }
}
.page-banner:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(58, 61, 65, 0.8);
}
.portfolio-page-banner {
    background: url('../../../images/parallax/back3.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.title-section.white {
    background: @white;
}

ul.filter {
    margin: 0;
    padding: 35px 0;
    background: #f9fafb;
    text-align: center;
}
ul.filter li {
    list-style: none;
    display: inline-block;
    margin-left: 25px;
}
ul.filter li a {
    .anchor;
    color: @skin-color3;
    font-size: 12px;
    font-weight: 700;
    padding-bottom: 6px;
    border-bottom: 1px solid transparent;
    font-family: @font;
    text-transform: uppercase;

}
ul.filter li a:hover,
ul.filter li a.active {
    color: @skin-color;
    border-bottom: 1px solid @skin-color;
}

.masonry.three-col {
    .project-post {
        width: 33.32%;
    }
}

.masonry.four-col {
    .project-post {
        width: 24.98%;
    }
}

.masonry.five-col {
    .project-post {
        width: 19.99%;
    }
}

.testimonials-section.transparent-back {
    background: @white;
    .testimonial-post {
        h2 {
            color: @skin-color3;
        }
        p {
            color: @color2;
            background: @white;
            border: 1px solid #dddddd;
        }
        p:after {
            position: absolute;
            content: '';
            width: 20px;
            height: 20px;
            background: @white;
            border: 1px solid #dddddd;
            border-bottom-color: transparent;
            border-right-color: transparent;
            left: 50%;
            margin-left: -10px;
            top: -10px;
            .rotate(45deg);
        }
    }

    .bx-wrapper .bx-pager.bx-default-pager a {
        background: transparent;
        border: 2px solid #dddddd;
    }

    .bx-wrapper .bx-pager.bx-default-pager a:hover,
    .bx-wrapper .bx-pager.bx-default-pager a.active {
        background: @skin-color;
        border: 2px solid @skin-color;
    }
}

.testimonials-section.transparent-back:after {
    display: none;
}

button.mfp-close, button.mfp-arrow {
    outline: none;
}

/*-------------------------------------------------*/
/* =  blog pages
/*-------------------------------------------------*/

.blog-page-banner {
    background: url('../../../images/parallax/banner1.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.blog-box.masonry {
    width: 1170px;
    margin-left: -15px;
    .blog-post {
        margin: 15px;
        width: 360px;
        .post-gal {
            position: relative;
            iframe {
                width: 100%;
            }
            .hover-box {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                background: rgba(255, 255, 255, 0.65);
                .transition;
                visibility: hidden;
                opacity: 0;
                a {
                    .anchor;
                    width: 40px;
                    height: 40px;
                    text-align: center;
                    .radius(50%);
                    background: @skin-color;
                    top: 50%;
                    left: 50%;
                    margin-left: 45px;
                    margin-top: -20px;
                    position: absolute;
                    .rotate(360deg);
                    .transition2;
                    i {
                        font-size: 14px;
                        color: @white;
                        line-height: 40px;
                    }
                }
                a:hover {
                    background: @skin-color3;
                }
            }
        }
    }
    .blog-post:hover {
        .post-gal {
            .hover-box {
                visibility: visible;
                opacity: 1;
                a {
                    margin-left: -20px;
                    .rotate(0deg);
                }
            }
        }
    }
}

.flex-direction-nav .flex-next {
    width: 40px; 
    height: 40px; 
    float: right;
    margin-right: 10px;
    background: @skin-color3;
    border: 1px solid @skin-color3;
    .box-shadow(0 3px 0 #5c5f62);
    .anchor;
    .radius(2px);
}

.flex-direction-nav .flex-prev {
    width: 40px; 
    height: 40px;  
    float: left;
    margin-left: 10px;
    background: @skin-color3;
    border: 1px solid @skin-color3;
    .box-shadow(0 3px 0 #5c5f62);
    .anchor;
    .radius(2px);
}

.flex-direction-nav .flex-next:after {
    content: '\f105';
    font-family: 'FontAwesome';
    font-size: 12px;
    color: @white;
    line-height: 40px;
}

.flex-direction-nav .flex-prev:after {
    content: '\f104';
    font-family: 'FontAwesome';
    font-size: 12px;
    color: @white;
    line-height: 40px;
}

.flexslider .flex-next:hover {
    background: @skin-color;
    border: 1px solid @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
}
.flexslider .flex-prev:hover {
    background: @skin-color;
    border: 1px solid @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
}

.categorize-blog {
    margin-bottom: 40px;
    ul.filter {
        padding: 10px 0 0;
    }
}

.view-more {
    padding-left: 45px !important;
    position: relative;
    i {
        position: absolute;
        left: 17px;
        top: 7px;
        display: inline-block;
        font-size: 22px !important;
    }
    margin-bottom: 50px !important;
}

.blog-section {
    position: relative;
}

a.go-top {
    position: absolute;
    bottom: 40px;
    right: 40px;
    .anchor;
    width: 60px;
    height: 60px;
    color: @color2;
    text-align: center;
    .radius(3px);
    border: 1px solid #e5e5e5;
    .box-shadow(0 3px 0 #e5e5e5);
    i {
        font-size: 22px;
        line-height: 60px;
    }
}
a.go-top:hover {
    border: 1px solid @color2;
}

.blog-section.with-sidebar {
    padding: 50px 0;
    .blog-post {
        margin-bottom: 60px;
        .post-content > p {
            .paragraph;
            padding: 20px;
            margin-bottom: 0;
            margin-left: 60px;
            color: @color2;
        }
        .post-content > a {
            margin-left: 80px;
        }
        iframe {
            width: 100%;
            height: 340px;
            margin-bottom: -6px;
        }
    }
}

.pagination-box {
    padding-top: 50px;
    padding-bottom: 20px;
    overflow: hidden;
    border-top: 1px solid #e5e5e5;
    a.prev {
        float: left;
        margin: 0;
    }
    a.next {
        float: right;
        margin: 0;
    }
}

.search-widget input[type="search"] {
    .paragraph;
    margin: 0;
    color: @skin-color3;
    padding: 10px 12px;
    border: 1px solid #e5e5e5;
    width: 100%;
    outline: none;
    .transition;
}

.search-widget input[type="search"]:focus {
    border: 1px solid @skin-color;
}

.search-widget button {
    background: #fff;
    border: none;
    float: right;
    margin-top: -32px;
    margin-right: 15px;
    position: relative;
    z-index: 2;
}

.search-widget button i {
    color: @skin-color;
    font-size: 16px;
}

.sidebar {
    .widget {
        margin-bottom: 40px;
        h3 {
            .heading3;
            color: @skin-color3;
            margin-bottom: 22px;
        }
        ul.category-list,
        ul.category-list {
            .ul-reset;
            li {
                list-style: none;
                margin-bottom: 22px;
                a {
                    .anchor;
                    padding-left: 20px;
                    text-transform: uppercase;
                    color: @skin-color3;
                    font-size: 12px;
                    font-family: @font;
                    position: relative;
                    font-weight: 700;
                }
                a:before {
                    position: absolute;
                    content: '';
                    width: 10px;
                    height: 10px;
                    border: 2px solid #e5e5e5;
                    left: 0;
                    top: 2px;
                    .transition;
                    .radius(50%);
                }
                a:hover {
                    color: @skin-color;
                }
                a:hover:before {
                    border: 2px solid @skin-color;
                    background: @skin-color;
                }
            }
            li:last-child {
                margin-bottom: 0;
            }
        }
        ul.popular-list {
            .ul-reset;
            li {
                list-style: none;
                padding-top: 24px;
                border-top: 1px solid #f5f5f5;
                margin-bottom: 24px;
                overflow: hidden;
                img {
                    float: left;
                    .radius(50%);
                }
                .side-content {
                    margin-left: 80px;
                    h2 {
                        .heading2;
                        font-size: 12px;
                        line-height: 20px;
                        margin: 0;
                        a {
                            .anchor;
                            color: @skin-color3;
                        }
                        a:hover {
                            color: @skin-color;
                        }
                    }
                    p {
                        .paragraph;
                        margin: 0;
                        color: #a9a9a9;
                    }
                }
            }
            li:first-child {
                list-style: none;
                padding-top: 0;
                border-top: none;
            }
            li:last-child {
                margin-bottom: 0;
            }
        }
    }
    .text-widget {
        p {
            .paragraph;
            color: @color2;
            margin: 0;
        }
    }
    ul.tags-list {
        .ul-reset;
        li {
            list-style: none;
            display: inline-block;
            margin-bottom: 3px;
            a {
                .anchor;
                padding: 9px;
                border: 1px solid #dcdcdc;
                .radius(2px);
                color: @color2;
                font-size: 12px;
                font-family: @font;
                font-weight: 300;
            }
            a:hover {
                color: @white;
                border: 1px solid @skin-color3;
                background: @skin-color3;
            }
        }
    }
}

.blog-box.masonry.one-col {
    width: 100%;
    margin-left: 0;
    .blog-post {
        width: 100%;
        margin: 0 0 60px;
        iframe {
            width: 100%;
            height: 360px;
        }
        .post-content > a {
            margin-left: 80px;
        }
    }
}

/*-------------------------------------------------*/
/* =  signle post
/*-------------------------------------------------*/
.blog-section.with-sidebar {
    overflow: hidden;
}

.single-post.blog-post .post-content > p {
    padding: 0 20px !important;
    margin-top: 20px !important;
    margin-bottom: 0px;
}

.single-post {
    overflow: hidden;
    blockquote {
        border: none;
        background: #f9fafb;
        border-left: 60px solid @skin-color;
        padding: 20px;
        position: relative;
        margin-top: 20px;
        p {
            .paragraph;
            margin: 0;
            font-weight: 700;
            color: @skin-color3;
        }
    }
    blockquote:before {
        position: absolute;
        content: '';
        width: 30px;
        height: 23px;
        top: 50%;
        left: -45px;
        margin-top: -12px;
        background: url('../images/quote.png') center center no-repeat;
    }
    .share-tag-box {
        margin-left: 80px;
        .post-tags {
            .ul-reset;
            margin-top: 20px;
            li {
                display: inline-block;
                a {
                    .anchor;
                    color: @skin-color3;
                    font-size: 13px;
                    font-family: @font;
                }
                a:hover {
                    color: @skin-color;
                    text-decoration: underline;
                }
            }
        }
        span {
            display: inline-block;
            color: @skin-color3;
            font-size: 13px;
            font-family: @font;
            font-weight: 700;
            margin-bottom: 8px;
        }
    }
    .pagination-boxer {
        overflow: hidden;
        margin-bottom: 40px;
        border: 1px solid #e5e5e5;
        .prev-post {
            float: left;
            width: 50%;
            border-right: 1px solid #e5e5e5;
            padding: 54px 30px;
            background: #f9fafb;
            .transition;
            a {
                float: left;
                margin: 0 20px 0 0;
            }
            p {
                .paragraph;
                margin: 0;
                font-weight: 700;
                color: @skin-color3;
            }
        }
        .next-post {
            float: right;
            width: 50%;
            padding: 54px 20px;
            background: #f9fafb;
            .transition;
            a {
                float: right;
                margin: 0 0 0 20px;
            }
            p {
                .paragraph;
                margin: 0;
                font-weight: 700;
                color: @skin-color3;
            }
        }
        .prev-post:hover {
            background: @white;
        }
        .next-post:hover {
            background: @white;
        }
    }
    .comment-section {
        h3 {
            .heading3;
            color: @skin-color3;
            margin-bottom: 50px;
        }
        ul {
            .ul-reset;
            li {
                list-style: none;
                img {
                    float: left;
                    width: 60px;
                    .radius(50%);
                }
                .comment-box {
                    border-bottom: 1px solid #e5e5e5;
                    padding-bottom: 42px;
                    margin-bottom: 50px;
                    overflow: hidden;
                }
                .comment-content {
                    margin-left: 80px;
                    h4 {
                        .heading2;
                        margin-bottom: 0;
                        font-size: 13px;
                        text-transform: inherit;
                    }
                    span {
                        .heading2;
                        font-size: 13px;
                        color: #333;
                        font-weight: 300;
                        margin-bottom: 12px;
                        text-transform: inherit;
                    }
                    p {
                        .paragraph;
                        font-weight: 300;
                        color: @color2;
                        margin-bottom: 10px;
                    }
                    a {
                        .anchor;
                        .heading2;
                        font-size: 13px;
                        color: #333;
                        font-weight: 300;
                        text-transform: inherit;
                    }
                    a:hover {
                        color: @skin-color;
                    }
                }
                .depth {
                    margin-left: 80px;
                }
            }
        }
    }
    .comment-form {
        h3 {
            .heading3;
            color: @skin-color3;
            margin-bottom: 50px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            display: inline-block;
            padding: 11px;
            background: @white;
            .radius(0);
            color: @color2;
            font-size: 13px;
            font-family: @font;
            border: 1px solid #e5e5e5;
            outline: none;
            margin: 0 0 20px;
            .transition;
        }
        input[type="text"]:focus,
        textarea:focus {
            border: 1px solid @skin-color;
        }
        textarea {
            min-height: 122px;
        }
        input[type="submit"] {
            display: inline-block;
            outline: none;
            padding: 10px 47px;
            color: @color2;
            font-size: 12px;
            font-family: @font;
            background: transparent;
            font-weight: 700;
            text-transform: uppercase;
            .radius(3px);
            border: 1px solid #e5e5e5;
            border-bottom: 3px solid #e5e5e5;
            .transition;
            background: @white;
        }
        input[type="submit"]:hover {
            border: 1px solid @color2;
            border-bottom: 3px solid @color2;
        }
    }
}

.social-box {
    .ul-reset;
    margin-bottom: 50px;
    margin-top: 5px;
    li {
        display: inline-block;
        a {
            .anchor;
            width: 28px;
            height: 28px;
            .radius(2px);
            text-align: center;
            background: #f8f8f8;
            i {
                font-size: 15px;
                line-height: 28px;
                color: #c3c3c3;
                .transition;
            }
        }
        a:hover {
            i {
                color: @white;
            }
        }
        a.facebook:hover {
            background: #3b5b94;
        }
        a.twitter:hover {
            background: #24cafe;
        }
        a.google:hover {
            background: #5b5b5b;
        }
        a.linkedin:hover {
            background: #0089b4;
        }
        a.dribble:hover {
            background: #ed4a8b;
        }
        a.pinterest:hover {
            background: #e84c3d;
        }
    }
}

/*-------------------------------------------------*/
/* =  single-project
/*-------------------------------------------------*/

.single-project {
    padding-bottom: 70px;
}

.project-block {
    padding-right: 50px;
    margin-bottom: 30px;
}
.single-project-content {
    padding-top: 60px;
    h1 {
        .heading1;
        margin-bottom: 0;
    }
    h3 {
        .heading3;
        color: @color2;
        font-weight: 400;
        margin-bottom: 32px;
    }
    p {
        .paragraph;
        margin-bottom: 20px;
        color: @color2;
        span {
            font-weight: 700;
        }
    }
}

.project-sidebar {
    margin-bottom: 30px;
    h1 {
        .heading1;
        margin-bottom: 0;
    }
    h3 {
        .heading3;
        color: @color2;
        font-weight: 400;
        margin-bottom: 32px;
    }
    ul.project-photos {
        .ul-reset;
        margin-bottom: 60px;
        overflow: hidden;
        li {
            float: left;
            margin-right: 10px;
            margin-bottom: 10px;
            position: relative;
            list-style: none;
            img {
                width: 175px;
            }
            a {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.85);
                opacity: 0;
                visibility: hidden;
                .anchor;
            }
        }
        li:nth-child(2n) {
            margin-right: 0;
        }
        li:hover {
            a {
                opacity: 1;
                visibility: visible;
            }
        }
    }
    p {
        .paragraph;
        font-weight: 700;
        color: @skin-color3;
        margin-bottom: 10px;
        span {
            color: @color2;
        }
        a {
            color: @skin-color;
        }
    }
    a.button-third {
        margin: 0;
        margin-top: 7px;
    }
}

/*-------------------------------------------------*/
/* =  about
/*-------------------------------------------------*/

.about-page-banner {
    background: url('../../../images/parallax/banner1.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.team-section {
    background: #f9fafb;    
}

.team-box {
    padding: 60px 0;
    position: relative;
    .buttons {
        position: absolute;
        width: 100%;
        height: 40px;
        top: 160px;
        left: 0;
        a.owl-prev {
            float: left;
            margin-left: -50px;
        }
        a.owl-next {
            float: right;
            margin-right: -50px;
        }
    }
}

.team-post {
    padding: 0 10px;
    img {
        width: 100%;
    }
    text-align: center;
    .team-head {
        padding: 16px 0 14px;
        position: relative;
        margin-bottom: 16px;
        h2 {
            .heading2;
        }
        span {
            .paragraph;
            font-size: 12px;
            margin: 0;
            color: @color2;
        }
    }
    .team-head:after {
        position: absolute;
        content: '';
        width: 60px;
        height: 1px;
        background: @skin-color3;
        bottom: 0;
        left: 50%;
        margin-left: -30px;
    }
    > p {
        .paragraph;
        color: #666666;
        font-size: 12px;
        margin: 0 0 10px;
    }
}

ul.team-social {
    .ul-reset;
    li {
        display: inline-block;
        a {
            .anchor;
            width: 40px;
            height: 40px;
            .radius(50%);
            border: 2px solid #d2d6da;
            -webkit-backface-visibility: hidden;
            text-align: center;
            i {
                font-size: 18px;
                color: #d2d6da;
                line-height: 40px;
                .transition;
            }
        }
        a:hover {
            background: @skin-color3;
            border: 2px solid @skin-color3;
            i {
                color: @white;
            }
        }
    }
}

.statistic-box.style2 {
    overflow: hidden;
    padding-bottom: 40px;
    border-bottom: 1px solid #e6eaed;
    .statistic-post {
        float: left;
        width: 25%;
        margin-bottom: 30px;
        .statistic-counter {
            padding: 22px 10px;
            background: #f9fafb;
            border: 1px solid #e6eaed;
            margin-bottom: 30px;
            overflow: hidden;
            p {
                color: @skin-color3;
                span {
                    color: @skin-color3;
                }
            }
        }
        .statistic-content {
            p {
                .paragraph;
                margin-bottom: 20px;
                color: #666;
                span {
                    .paragraph;
                    color: #666;
                    font-weight: 700;
                    margin: 0;
                    line-height: 20px;
                }
            }
        }
    }
}

.skills-accord-section {
    padding: 60px 0;
    .accord-box,
    .skills-box {
        margin-bottom: 30px;
        > h1 {
            .heading1;
        }
        > p {
            .paragraph;
            font-size: 18px;
            color: @color2;
            margin-bottom: 50px;
        }
    }
}

.skills-progress > p {
    .heading2;
    padding-bottom: 12px;
    margin: 0;
    text-transform: inherit;
    position: relative;
}
.meter { 
    height: 8px;  /* Can be anything */
    position: relative;
    background: transparent;
    border: 1px solid #d2d6da;
    margin-bottom: 19px;
    padding: 2px;
    .radius(3px);
}
.meter > p {
    display: block;
    height: 2px;
    position: relative;
    background: @skin-color;
    span {
        position: absolute;
        right: -15px;
        top: -47px;
        color: @white;
        font-size: 14px;
        font-weight: 700;
        font-family: @font;
        background: @skin-color3;
        padding: 8px 3px 6px;
        .radius(2px);
    }
    span:after {
        position: absolute;
        content: '';
        width: 0;
        height: 0;
        border: 5px solid @skin-color3;
        border-left-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        left: 50%;
        margin-left: -5px;
        bottom: -10px;
    }
}

/*-------------------------------------------------*/
/* =  services
/*-------------------------------------------------*/
.services-page-banner {
    background: url('../../../images/parallax/banner2.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.features-section2 {
    .features-box-services {
        .feature-list {
            margin-top: 70px;
        }
    }
    .image-place {
        margin-bottom: 40px;
    }   
}

.tab-section {
    background: url('../../../images/parallax/back7.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    position: relative;
    padding: 50px 0 40px;
    .container {
        position: relative;
        z-index: 2;
    }
}

.tab-section:after {
    position: absolute;
    content: '';
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(58, 61, 65, 0.8);
}

.tab-box {
    .container {
        h1 {
            .heading1;
            color: @white;
            margin-bottom: 15px;
            text-align: center;
        }
        > p {
            .paragraph;
            font-size: 14px;
            margin: 0 auto;
            text-align: center;
            max-width: 900px;
        }
    }
}

.nav-tabs {
    border: none;
    margin-top: 60px;
    li {
        border-top: 2px solid @skin-color3;
        margin: 0;
        width: 25%;
        .transition;
        a {
            .anchor;
            .radius(0px);
            background: @skin-color3;
            display: block;
            border: none !important;
            margin: 0;
            width: 100%;
            padding: 30px 10px;
            overflow: hidden;
            span {
                display: inline-block;
                float: left;
                width: 40px;
                height: 40px;
                .radius(50%);
                background: @skin-color;
                color: @white;
                text-align: center;
                line-height: 40px;
                font-size: 18px;
                font-family: arial;
                font-weight: 700;
            }
            h2 {
                .heading2;
                color: @white;
                font-size: 18px;
                text-transform: inherit;
                margin: 3px 0 0 60px;
                .transition;
            }
            p {
                .paragraph;
                font-size: 12px;
                font-weight: 700;
                margin: 0;
                margin-left: 60px;
                .transition;
            }
        }
        a:hover {
            background: @skin-color3;
            opacity: 0.7;
        }
    }
    li.active {
        border-top: 2px solid @skin-color;
        a {
            background: @white;
            h2 {
                color: @skin-color3;
            }
            p {
                color: @color2;
            }
        }
    }
}
.tab-content {
    border: none;
    margin-bottom: 40px;
    .tab-pane {
        padding: 45px 30px;
        overflow: hidden;
        background: @white;
        h2 {
            .heading2;
            font-size: 18px;
            text-transform: inherit;
            margin: 0 0 16px;
        }
        p {
            .paragraph;
            color: @color2;
            margin-bottom: 10px;
        }
    }
}

.pricing-box {
    overflow: hidden;
    padding-bottom: 100px;
    padding-top: 10px;
    .pricing-item {
        width: 25%;
        float: left;
        margin-bottom: 20px;
        padding-bottom: 10px;
        .transition;
        ul.pricing-table {
            .ul-reset;
            .transition;
            width: 100%;
            border-bottom: 1px solid @skin-color3;
            .transition;
            li {
                width: 100%;
                list-style: none;
                text-align: center;
                padding: 6px 0;
                background: @white;
                .transition;
                p {
                    .paragraph;
                    color: @color2;
                    margin: 0;
                    .transition;
                }
                a {
                    margin: 15px 0 28px;
                }
            }
            li:first-child {
                padding: 34px 0 30px;
                border: none;
                background: @skin-color3;
                margin-bottom: 24px;
                h1 {
                    .heading1;
                    color: @white;
                    margin-bottom: 40px;
                }
                p {
                    color: @white;
                    font-size: 14px;
                    font-weight: 700;
                    font-family: @font;
                    margin: 0;
                    span {
                        display: inline-block;
                        font-size: 60px;
                        margin: 0 6px;
                    }
                }
            }
        }
    }
    .pricing-item:hover {
        padding-bottom: 0;
        ul.pricing-table {
            background: #f9fafb;
            border-bottom: 1px solid @skin-color;
            margin-top: -10px;
            li {
                p {
                    color: @skin-color3;
                }
                a {
                    margin-bottom: 38px;
                }
            }
            li:first-child {
                padding: 44px 0 30px;
                background: @skin-color;
                p {
                    color: @white;
                }
            }
        }
    }
}

/*-------------------------------------------------*/
/* =  contact
/*-------------------------------------------------*/
.contact-page-banner {
    background: url('../../../images/parallax/banner2.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.map {
    height: 330px;
}

.contact-info {
    padding: 40px 0;
    text-align: center;
    a {
        .anchor;
        width: 60px;
        height: 60px;
        .radius(50%);
        background: @skin-color;
        margin-bottom: 12px;
        i {
            line-height: 60px;
            color: @white;
            font-size: 30px;
        }
    }
    h2 {
        .heading2;
        text-transform: inherit;
        margin-bottom: 30px;
    }
    p {
        .paragraph;
        color: @color2;
        padding: 23px;
        border: 1px solid #dfdfdf;
        .radius(8px);
        position: relative;
        span {
            display: block;
        }
    }
    p:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 1px solid #dfdfdf;
        border-bottom-color: transparent;
        border-right-color: transparent;
        top: -10px;
        left: 50%;
        margin-left: -10px;
        .rotate(45deg);
        background: #fff;
    }
}

.contact-area {
    background: #f9fafb;
    .title-section {
        padding-bottom: 30px;
    }
    #contact-form {
        padding-bottom: 30px;
        p {
            .paragraph;
            color: @color2;
            text-align: center;
            max-width: 660px;
            margin: 0 auto 40px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            display: inline-block;
            padding: 11px;
            background: @white;
            .radius(0);
            color: @color2;
            font-size: 13px;
            font-family: @font;
            border: 1px solid #e5e5e5;
            outline: none;
            margin: 0 0 20px;
            .transition;
        }
        input[type="text"]:focus,
        textarea:focus {
            border: 1px solid @skin-color;
        }
        textarea {
            min-height: 122px;
        }
        input[type="submit"] {
            display: inline-block;
            outline: none;
            padding: 10px 47px;
            color: @color2;
            font-size: 12px;
            font-family: @font;
            background: transparent;
            font-weight: 700;
            text-transform: uppercase;
            .radius(3px);
            border: 1px solid #e5e5e5;
            border-bottom: 3px solid #e5e5e5;
            .transition;
            background: @white;
        }
        input[type="submit"]:hover {
            border: 1px solid @color2;
            border-bottom: 3px solid @color2;
        }
        .submit-area {
            text-align: center;
        }
        .message {
            height:30px;
            font-size:13px;
            font-family: @font;
        }
        .message.error {
            color:#e74c3c;
        }
        .message.success {
            color: @skin-color3;
            padding: 30px 0;
        }
    }
}

/*-------------------------------------------------*/
/* =  error
/*-------------------------------------------------*/

.error-page-banner {
    background: url('../../../images/parallax/banner1.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.error {
    padding: 70px 0;
    text-align: center;
    span {
        display: inline-block;
        width: 164px;
        height: 164px;
        .radius(50%);
        background: @skin-color;
        color: @white;
        line-height: 150px;
        font-size: 60px;
        font-family: @font;
        font-weight: 700;
        position: relative;
    }
    span:after {
        content: '';
        position: absolute;
        width: 178px;
        height: 178px;
        .radius(50%);
        border: 1px solid @skin-color;
        top: -7px;
        left: -7px;
    }
}
.error-content {
    text-align: center;
    padding: 50px 0;
    background: #f9fafb;
    h1 {
        .heading1;
        margin-bottom: 12px;
    }
    p {
        .paragraph;
        font-size: 14px;
        margin-bottom: 40px;
        color: @color2;
    }
    a {
        color: @skin-color3;
    }
}

/*-------------------------------------------------*/
/* =  testimonials page
/*-------------------------------------------------*/

.testimonial-page-banner {
    background: url('../../../images/parallax/banner2.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.test-style1 {
    margin-bottom: 58px;
}

/*-------------------------------------------------*/
/* =  faqs page
/*-------------------------------------------------*/

.faqs-page-banner {
    background: url('../../../images/parallax/banner1.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.toggle-section {
    padding: 55px 0;
    margin-bottom: 100px;
}

.accord-elem {
    margin-top: 8px;
}
.accord-elem:first-child {
    margin-top: 0px;
}
.accord-title {
    padding: 16px 20px;
    background: @white;
    border: 1px solid #e6eaed;
    position: relative;
    h2 {
        padding-right: 52px;
        .heading2;
        margin-bottom: 0;
        font-size: 14px;
        color: @skin-color3;
        text-transform: inherit;
    }
    a.accord-link {
        .anchor;
        position: absolute;
        width: 52px;
        height: 100%;
        top: 0;
        right: 0;
        text-align: center;
    }
    a.accord-link:after {
        font-family: @font;
        content: '+';
        font-size: 42px;
        color: @skin-color;
        font-weight: 600;
        line-height: 49px;
    }
}
.accord-elem.active .accord-title {
    background: #f9fafb;
    border-bottom: 1px solid transparent;
}
.accord-elem.active a.accord-link:after {
    content: ' -';
}
.accord-content {
    display: none;
    padding: 15px 20px;
    border: 1px solid #e6eaed;
    border-top: 1px solid transparent;
    overflow: hidden;
    p {
        .paragraph;
        color: @color2;
        span {
            color: #666666;
            font-weight: 700;
        }
    }
}
.accord-elem.active .accord-content {
    display: block;
}

/*-------------------------------------------------*/
/* =  shortcodes
/*-------------------------------------------------*/

.shortcodes-page-banner {
    background: url('../../../images/parallax/banner2.jpg');
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.shortcodes-section {
    padding: 35px 0 75px;
    .shortcodes-elem {
        margin-bottom: 50px;
        > h1,
        .skills-box h1,
        .accord-box h1,
        .buttons-area h1,
        .social-icons-area h1 {
            .heading1;
            padding-bottom: 20px;
            border-bottom: 1px solid #e6eaed;
            margin-bottom: 24px;
            text-align: center;            
        }
        .skills-box h1,
        .accord-box h1,
        .buttons-area h1,
        .social-icons-area h1 {
            text-align: left;
        }
    }
    .back-col {
        background: @skin-color3;
        padding: 30px 10px 0;
        margin-top: -24px;
        .testimonial-post {
            padding-bottom: 30px;
        }
    }
    .statistic-box {
        padding-bottom: 0;
        .statistic-counter {
            margin: 0;
        }
        .statistic-post {
            margin-bottom: 20px;
        }
    }
    .statistic-box.back-col {
        padding: 50px 10px 20px;
    }
    .pricing-box {
        padding-bottom: 0;
    }
    .testimonials-section {
        padding: 0;
    }
    .button-area {
        margin-bottom: 20px;
    }
    .social-area {
        margin-bottom: 20px;
    }
    .social-area.with-back {
        padding: 15px;
        background: @skin-color;
    }
}
a.button-large {
    .anchor;
    background: @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
    .radius(3px);
    padding: 12px 40px;
    color: @white;
    font-size: 18px;
    font-family: @font;
    font-weight: 700;
}

a.button-large:hover {
    background: @skin-color3;
    .box-shadow(0 3px 0 #222222);
    color: @white;
}

a.small-btn {
    .anchor;
    background: @skin-color;
    border: 1px solid @skin-color;
    .box-shadow(0 3px 0 @skin-color2);
    .radius(3px);
    padding: 10px 30px;
    color: @white;
    font-size: 12px;
    font-family: @font;
    font-weight: 700;
    text-transform: uppercase;
}

a.small-btn:hover {
    background: @white;
    border: 1px solid #999999;
    .box-shadow(0 3px 0 #fafafa);
    color: #e7eaec;
}

a.button-third.load-more {
    color: @skin-color3;
    i {
        margin-right: 25px;
    }
}

a.button-fourth {
    .anchor;
    width: 60px;
    height: 60px;
    color: @color2;
    text-align: center;
    .radius(3px);
    border: 1px solid #e5e5e5;
    .box-shadow(0 3px 0 #e5e5e5);
    i {
        font-size: 22px;
        line-height: 60px;
    }
}
a.button-fourth:hover {
    border: 1px solid @color2;
}

/*-------------------------------------------------*/
/* =  footer
/*-------------------------------------------------*/

ul.social-icons {
    .ul-reset;
    li {
        display: inline-block;
        margin-left: 8px;
        a {
            .anchor;
            width: 40px;
            height: 40px;
            .radius(2px);
            text-align: center;
            border: 1px solid transparent;
            background: @skin-color;
            i {
                font-size: 22px;
                line-height: 40px;
                color: @white;
            }
        }
        a:hover {
            border: 1px solid @white;
        }
    }
}

footer {
    .social-section {
        background: @skin-color;
        padding: 15px;
        text-align: center;
    }
    .up-footer {
        background: url('../../../images/bg/pattern.png');
        padding: 70px 0 30px;
        h1 {
            .heading1;
            color: @white;
            margin-bottom: 35px;
        }
        p {
            .paragraph;
            margin-bottom: 15px;
        }
        .footer-widget {
            margin-bottom: 30px;
        }
        .text-widget {
            img {
                margin-top: 10px;
            }
        }
        .tweets-widget {
            ul {
                .ul-reset;
                li {
                    list-style: none;
                    margin-bottom: 30px;
                    i {
                        display: inline-block;
                        float: left;
                        font-size: 15px;
                        color: @white;
                        margin-top: 4px;
                        margin-left: 4px;
                    }
                    p {
                        margin: 0 0 0 30px;
                        a {
                            display: block;
                            color: @skin-color;
                        }
                    }
                    span {
                        .paragraph;
                        margin: 0 0 0 30px;
                        color: @color2;
                        display: inline-block;
                    }
                }
            }
        }
        .flickr-widget {
            ul {
                .ul-reset;
                li {
                    display: inline-block;
                    margin-bottom: 5px;
                    margin-right: 2px;
                    a {
                        .anchor;
                        img {
                            width: 70px;
                        }
                    }
                    a:hover {
                        opacity: 0.7;
                    }
                }
            }
        }
        .subscribe-form input[type="text"] {
            display: inline-block;
            padding: 12px 10px;
            background: @white;
            .radius(0);
            color: #c8c8c8;
            font-size: 13px;
            font-family: @font;
            min-width: 160px;
            border: none;
            outline: none;
            margin: 0;
            margin-right: -5px;
        }
        .subscribe-form input[type="submit"] {
            display: inline-block;
            padding: 13px 8px 12px;
            background: @skin-color;
            .radius(0);
            color: @white;
            font-size: 12px;
            font-weight: 700;
            font-family: @font;
            text-transform: uppercase;
            border: none;
            outline: none;
            margin: 0;
            .transition;
        }
        .subscribe-form input[type="submit"]:hover {
            opacity: 0.7;
        }
        .footer-line{
            margin-top: 50px;
            padding-top: 32px;
            border-top: 1px solid #595c60;
            text-align: center;
            p {
                color: @color2;
                margin-bottom: 0;
            }
        }
    }
}

/*-------------------------------------------------*/
/* =  Responsive Part
/*-------------------------------------------------*/

@media (max-width: 1500px) {
    .masonry.five-col .project-post {
        width: 24.975%
    }
}

@media (max-width: 1199px) {
    footer .up-footer .subscribe-form input[type="text"] {
        margin-bottom: 10px;
    }
    .nav-tabs li a p {
        font-size: 10px;
    }
    .blog-box.masonry {
        width: 970px;
        .blog-post {
            width: 293px;
        }
    }
    .masonry.four-col .project-post,
    .masonry.five-col .project-post {
        width: 33.3%;
    }
    .project-sidebar ul.project-photos li img {
        width: 140px;
    }
}

@media (max-width: 991px) {
    .navbar-nav > li {
        margin-left: 0;
    }
    .nav > li > a {
        padding: 15px 12px;
        padding-bottom: 22px;
    }
    .slider1 .banner-thumbs {
        display: none;
    }
    .tp-caption.medium_thin_white .button-large,
    .tp-caption.medium_thin_grey .button-large {
        padding: 10px 20px;
        margin: 0 5px;
    }
    .features-section .container .image-place {
        text-align: left;
        img {
            margin-bottom: 20px;
            max-width: 100%;
        }
    }
    .statistic-post {
        margin-bottom: 20px;
        text-align: center;
    }
    .pricing-box .pricing-item {
        width: 50%;
        margin-bottom: 20px;
    }
    .pricing-box .pricing-item:hover {
        ul.pricing-table {
            margin-bottom: 10px;
            li {
                a {
                    margin-bottom: 28px;
                }
            }
        }
    }
    .statistic-box.style2 .statistic-post {
        width: 50%;
    }
    .nav-tabs li {
        width: auto;
    }
    .nav-tabs li a h2,
    .nav-tabs li a p {
        display: none;
    }
    .blog-box.masonry {
        width: 750px;
        .blog-post {
            width: 345px;
        }
    }
    .masonry.three-col .project-post,
    .masonry.four-col .project-post,
    .masonry.five-col .project-post {
        width: 49.98%;
    }
    .project-block {
        padding-right: 0;
    }
    .project-sidebar ul.project-photos li {
        margin-right: 10px !important;
    }
}

@media (max-width: 767px) {
    .navbar-toggle {
        margin-top: 15px;
    }
    .nav > li > a {
        padding: 5px 15px;
    }
    .navbar-nav li ul.drop-down,
    .navbar-nav li ul.drop-down li ul.drop-down.level3 {
        background: transparent;
        border: none;
        .rotateX(0deg);
        .rotateY(0deg);
        position: relative;
        width: auto;
        visibility: visible;
        opacity: 1;
        top: inherit;
        left: inherit;
        li {
            a {
                background: none !important;
                color: @skin-color3;
                font-size: 12px;
                text-transform: inherit;
                padding: 4px 20px;
            }
            a:hover {
                color: @skin-color;
            }
        }
    }
    .form-search {
        position: relative;
        top: inherit;
        right: inherit;
        width: auto;
        margin: 5px 15px;
        visibility: visible;
        opacity: 1;
        .rotateX(0deg);
    }
    a.open-search {
        display: none !important;
    }
    .tp-caption.medium_thin_white {
        font-size: 22px;
    }
    .tp-caption.medium_thin_white .button-large,
    .tp-caption.medium_thin_grey .button-large {
        padding: 5px 5px;
        margin: 0 2px;
        font-size: 10px;
    }
    .client-section .bx-wrapper .bx-controls-direction {
        display: none;
    }
    .bx-wrapper {
        margin: 0 auto 20px;
    }
    .pricing-box .pricing-item {
        width: 100%;
    }
    .team-box .buttons a.owl-prev {
        margin-left: 0;
    }
    .team-box .buttons a.owl-next {
        margin-right: 0;
    }
    .team-box .buttons {
        width: 90px;
        height: 40px;
        top: -35px;
        left: 10px;
    }
    a.go-top {
        bottom: 10px;
        right: 15px;
        width: 45px;
        height: 45px;
        i {
            line-height: 45px;
        }
    }
    .blog-box.masonry {
        width: 100%;
        margin-left: 0;
        .blog-post {
            width: 100%;
            margin: 15px 0;
        }
    }
    .masonry.three-col .project-post,
    .masonry.four-col .project-post,
    .masonry.five-col .project-post {
        width: 100%;
    }
}

@media (max-width: 581px) {
    .statistic-box.style2 .statistic-post {
        width: 100%;
    }
}