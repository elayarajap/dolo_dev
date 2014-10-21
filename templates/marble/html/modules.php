<?php
/**
 * @package     ShineTheme
 * @subpackage  Templates.presence
 *
 * @copyright   Copyright (C) 2014 ShineTheme
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
/*
 * Module chrome for rendering the module in a submenu
 */

function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_well($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo "<div class=\"well " . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		if ($module->showtitle)
		{
			echo "<h3 class=\"page-header\">" . $module->title . "</h3>";
		}
		echo $module->content;
		echo "</div>";
	}
}
function modChrome_footercolumns($module, &$params, &$attribs)
{
	$colclass = '';
	switch ($attribs['columns']) {
		case '1':
			$colclass = 'col-md-12';
			break;
		case '2':
			$colclass = 'col-md-6';
			break;
		case '3':
			$colclass = 'col-md-4';
			break;
		case '4':
			$colclass = 'col-md-3';
			break;
		case '6':
			$colclass = 'col-md-2';
			break;
		default:
			$colclass = 'col-md-3';
			break;
	}
	if ($module->content)
	{
		echo "<div class=\"" .$colclass. "\">";
			echo "<div class=\"widget footer-widget ". htmlspecialchars($params->get('moduleclass_sfx')) ."\">";
			if ($module->showtitle)
			{
				echo "<h1>" . $module->title . "</h1>";
			}
				echo $module->content;
			echo "</div>";						
		echo "</div>";
	}
}

function modChrome_skillscolumns($module, &$params, &$attribs)
{
	$colclass = '';
	switch ($attribs['columns']) {
		case '1':
			$colclass = 'col-md-12';
			break;
		case '2':
			$colclass = 'col-md-6';
			break;
		case '3':
			$colclass = 'col-md-4';
			break;
		case '4':
			$colclass = 'col-md-3';
			break;
		case '6':
			$colclass = 'col-md-2';
			break;
		default:
			$colclass = 'col-md-3';
			break;
	}
	if ($module->content)
	{
		echo "<div class=\"" .$colclass.' '.htmlspecialchars($params->get('moduleclass_sfx')) ."\">";
			if ($module->showtitle)
			{
				echo "<h1>" . $module->title . "</h1>";
			}
				echo $module->content;					
		echo "</div>";
	}
}

function modChrome_widget($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo "<div class=\"widget " . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		if ($module->showtitle)
		{
			echo "<h3>" . $module->title . "</h3>";
		}
		echo $module->content;
		echo "</div>";
	}
}
function modChrome_shortcodes($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo "<div class=\"shortcodes-elem " . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		if ($module->showtitle)
		{
			echo "<h1>" . $module->title . "</h1>";
		}
		echo $module->content;
		echo "</div>";
	}
}
function modChrome_slider($module, &$params, &$attribs){
	if($module->content){
		echo "<div id=\"slider\" class=\"" . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		echo "<!--";
			echo "#################################";
				echo "- THEMEPUNCH BANNER -";
			echo "#################################";
			echo "-->";
			if ($module->showtitle)
			{
				echo "<h1>" . $module->title . "</h1>";
			}
			echo $module->content;
		echo "</div>";
	}
}
?>
