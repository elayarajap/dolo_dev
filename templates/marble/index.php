<?php
/**
 * @author AAAtheme - www.aaatheme.com
 * @date: 21-05-2014
 *
 * @copyright  Copyright ( C ) 2014 aaatheme.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$title = $doc->getTitle();
$this->language = $doc->language;

$pageType = "multiPage";

$active = JFactory::getApplication()->getMenu()->getActive();
if(isset($active)){
	if($active->params->get('pageType')){
		$pageType = $active->params->get('pageType');
	}
}

$input = $app->input;

// unset($doc->_scripts[JURI::root(true)."/media/system/js/mootools-core.js"]);
// unset($doc->_scripts[JURI::root(true)."/media/system/js/core.js"]);
// unset($doc->_scripts[JURI::root(true)."/media/system/js/mootools-more.js"]);
// unset($doc->_scripts[JURI::root(true)."/media/jui/js/jquery.min.js"]);
// unset($doc->_scripts[JURI::root(true)."/media/jui/js/jquery-noconflict.js"]);
// unset($doc->_scripts[JURI::root(true)."/media/jui/js/jquery-migrate.min.js"]);
// unset($doc->_scripts[JURI::root(true)."/components/com_k2/js/k2.js?v2.6.7&amp;sitepath=".JURI::base(true)."/"]);

$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

// Adjusting content width
if ($this->countModules('left-sidebar') && $this->countModules('right-sidebar'))
{
	$col = "col-md-6";
}
elseif ($this->countModules('left-sidebar') && !$this->countModules('right-sidebar'))
{
	$col = "col-md-9";
}
elseif (!$this->countModules('left-sidebar') && $this->countModules('right-sidebar'))
{
	$col = "col-md-9";
}
else
{
	$col = "col-md-12";
}

$favicon = $params->get('favicon');
$logoImage = $params->get('logoImage');
if(!empty($logoImage)){
	$logo = '<img alt="'.$sitename.'" src="'.JURI::base(true).'/'.$logoImage.'">';
}else{
	$logo = "<h1>".$params->get('logoText')."</h1>";
}
$fD = $params->get('fontDefault', 'Raleway');
$cS = substr($params->get('colorSkin', '#e74c3c'),1);
$cS2 = substr($params->get('colorSkin2', '#9e2114'),1);
$hTC = substr($params->get('headingTextColor', '#3a3d41'),1);
$tC1 = substr($params->get('textColor1', '#dddddd'),1);
$tC2 = substr($params->get('textColor2', '#999999'),1);
$wC = substr($params->get('whiteColor', '#ffffff'),1);
$bC = substr($params->get('blackColor', '#000000'),1);
$overrideColor = $params->get('overrideColor','0');
if($overrideColor === '0') {
	$preMadeSkin = $params->get('preMadeSkin','marble');
	switch ($preMadeSkin) {
		case 'medicine':
			$cS = '3ab0e4';
			$cS2 = '0384ce';
			$hTC = '3a3d41';
			$tC1 = 'dddddd';
			$tC2 = '999999';
			$wC = 'ffffff';
			$bC = '000000';
			break;
		case 'coffee' :
			$cS = 'f5ab35';
			$cS2 = 'c37800';
			$hTC = '3a3d41';
			$tC1 = 'dddddd';
			$tC2 = '999999';
			$wC = 'ffffff';
			$bC = '000000';
			break;
		
		default:
			$cS = 'e74c3c';
			$cS2 = '9e2114';
			$hTC = '3a3d41';
			$tC1 = 'dddddd';
			$tC2 = '999999';
			$wC = 'ffffff';
			$bC = '000000';
			break;
	}
}
?>
<!doctype html>


<html lang="en" class="no-js">
<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	

	<!-- Standard Favicon--> 
	<link rel="shortcut icon" href="<?php echo JURI::base(true). (!empty($favicon)? '/'.$favicon : '/images/favicon/favicon.ico');?>">

	<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300,100,200' rel='stylesheet' type='text/css'>


	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/bootstrap.css" media="screen">	
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/owl.carousel.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/owl.theme.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/jquery.bxslider.css" media="screen">
	<!-- CSS Blog fullwidth -->
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/flexslider.css" media="screen">

	<link media="screen" title="Green" type="text/css" href="<?php echo JURI::base(true)?>/media/system/css/calendar-jos.css" rel="stylesheet">
	<link type="text/css" href="<?php echo JURI::base(true)?>/media/jui/css/chosen.css" rel="stylesheet">
	<!-- CSS Blog fullwidth -->
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/magnific-popup.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/font-awesome.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/animate.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/forms.css" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/icomoon.css" media="screen">


    <!-- REVOLUTION BANNER CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/settings.css" media="screen" />
	<link rel="stylesheet/less" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/less/style.php?fd=<?php echo $fD;?>&amp;cs=<?php echo $cS;?>&amp;cs2=<?php echo $cS2;?>&amp;htc=<?php echo $hTC;?>&amp;tc1=<?php echo $tC1;?>&amp;tc2=<?php echo $tC2;?>&amp;wc=<?php echo $wC;?>&amp;bc=<?php echo $bC;?>" media="screen">

	<!-- TEMPLATE CUSTOM CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/css/custom.css" media="screen">
	

	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.migrate.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.magnific-popup.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.appear.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.countTo.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.imagesloaded.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/retina-1.1.0.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/plugins-scroll.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/waypoint.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.stellar.min.js"></script>
	



	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/less.js"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/script.js"></script>
	
	<jdoc:include type="head" />	
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/js/jchartfx.system.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/js/jchartfx.coreVector.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/js/jchartfx.coreVector3d.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/js/jchartfx.advanced.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/js/jchartfx.gauge.js"></script>
	<script type="text/javascript" src="<?php echo JURI::base(true);?>/includes/charts/motifs/jchartfx.motif.js"></script>
	

</head>
<body>

	<!-- Container -->
	<div id="container">
		<!-- Header
		    ================================================== -->
		<header class="clearfix<?php if($pageType == 'onePage') echo ' one-page';?>">
			<!-- Static navbar -->
			<div class="navbar navbar-default navbar-fixed-top">			
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href=""><?php echo $logo;?></a>
					</div>
					<div class="navbar-collapse collapse">
						<?php if ($this->countModules('static-menu')) : ?>
					  		<jdoc:include type="modules" name="static-menu" style="no" />
						<?php endif;?>
					</div>
				</div>
			</div>
		</header>
		<!-- End Header -->

		<!-- slider 
			================================================== -->
		
			<?php if ($this->countModules('rev-slider')) : ?>
		  		<jdoc:include type="modules" name="rev-slider" style="slider" />
			<?php endif;?>
		<!-- Ed slider -->

		<!-- content 
			================================================== -->
		<div id="content">

			<?php if ($this->countModules('home-banner')) : ?>
		  		<jdoc:include type="modules" name="home-banner" style="no" />
			<?php endif;?>

<?php if($this->countModules('left-sidebar') || $this->countModules('right-sidebar')) : ?>
<!-- blog-section 
================================================== -->
<div class="section-content blog-section with-sidebar">
	<div class="container">
		<div class="blog-box">
			<div class="row">
			<?php if($this->countModules('left-sidebar')) : ?>
				<div class="col-md-3">
					<div class="sidebar triggerAnimation animated" data-animate="slideInUp">
						<jdoc:include type="modules" name="left-sidebar"  style="widget" />
					</div>
				</div>
			<?php endif;?>
			<div class="<?php echo $col;?>">
<?php endif;?>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
<?php if($this->countModules('left-sidebar') || $this->countModules('right-sidebar')) : ?>
			</div>
			<?php if($this->countModules('right-sidebar')) : ?>
				<div class="col-md-3">
					<div class="sidebar triggerAnimation animated" data-animate="slideInUp">
						<jdoc:include type="modules" name="right-sidebar"  style="widget" />
					</div>
				</div>
			<?php endif;?>
			</div>
		</div>
	</div>
	<a class="go-top" href="#"><i class="fa fa-arrow-circle-o-up"></i></a>
</div>
<?php endif;?>
			
			<?php if ($this->countModules('position-1')) : ?>
		  		<jdoc:include type="modules" name="position-1" style="no" />
			<?php endif;?>

			

			<?php if ($this->countModules('position-2')) : ?>
		  		<jdoc:include type="modules" name="position-2" style="no" />
			<?php endif;?>

			<?php if ($this->countModules('position-3')) : ?>
		  		<jdoc:include type="modules" name="position-3" style="no" />
			<?php endif;?>

			<?php if ($this->countModules('position-4')) : ?>
		  		<jdoc:include type="modules" name="position-4" style="no" />
			<?php endif;?>
			
			<?php if ($this->countModules('position-5')) : ?>
		  		<jdoc:include type="modules" name="position-5" style="no" />
			<?php endif;?>

			<?php if ($this->countModules('position-6')) : ?>
		  		<jdoc:include type="modules" name="position-6" style="no" />
			<?php endif;?>

			<?php if($this->countModules('position-7')) : ?>
				<jdoc:include type="modules" name="position-7" style="no" />
			<?php endif;?>

			<?php if($this->countModules('shortcodes')) : ?>
			<!-- shortcodes-section
			================================================== -->
			<div class="section-content shortcodes-section">
				<div class="container">
					<jdoc:include type="modules" name="shortcodes" style="shortcodes" />
				</div>
			</div>
			<?php endif;?>
			
			<?php if ($this->countModules('skills-accord')) : ?>
				<!-- skills-accord-section 
				================================================== -->
				<div class="section-content skills-accord-section">
					<div class="container">
						<div class="row">
							<jdoc:include type="modules" name="skills-accord" columns="<?php echo $this->countModules('skills-accord');?>" style="skillscolumns" />
						</div>
					</div>
				</div>		
				  		
			<?php endif;?>

			<?php if ($this->countModules('position-8')) : ?>
		  		<jdoc:include type="modules" name="position-8" style="no" />
			<?php endif;?>

			<?php if($this->countModules('position-9')) : ?>
				<jdoc:include type="modules" name="position-9" style="no" />
			<?php endif;?>

			

			<?php if($this->countModules('contact')) : ?>
			<!-- contact section 
			================================================== -->
			<div id="contact-section" class="section-content contact-section">
				<jdoc:include type="modules" name="contact" style="no" />
			</div>
			<?php endif;?>
					
			<?php if($this->countModules('home-clients')) : ?>
				<jdoc:include type="modules" name="home-clients" style="no" />
			<?php endif;?>
		</div>
		<!-- End content -->

		<?php if($this->countModules('social-icons or up-footer or footer-line')) : ?>
		<!-- footer 
			================================================== -->
		<footer>
		<?php if ($this->countModules('social-icons')) : ?>
			<div class="social-section">
				<ul class="social-icons triggerAnimation animated" data-animate="tada">
					
							<jdoc:include type="modules" name="social-icons"  style="no" />
					
					
				</ul>
			</div>
		<?php endif;?>
			<div class="up-footer">
				<div class="container">
					<div class="row">
					<?php if ($this->countModules('up-footer')) : ?>
						
							<jdoc:include type="modules" name="up-footer" columns="<?php echo $this->countModules('up-footer');?>" style="footercolumns" />
						
				  		
					<?php endif;?>
						

						

						

						

					</div>
					<?php if ($this->countModules('footer-line')) : ?>
						<div class="footer-line">
							<jdoc:include type="modules" name="footer-line" style="no" />
						</div>
				  		
					<?php endif;?>
					
				</div>
			</div>

		</footer>
		<!-- End footer -->
	<?php endif;?>
	</div>
	<!-- End Container -->
	
	<!-- Blog fullwidth JS -->
		<script type="text/javascript" src="<?php echo JURI::base(true).'/templates/'.$this->template; ?>/js/jquery.flexslider.js"></script>
</body>
</html>