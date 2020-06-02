<?php
/**
 * @copyright	Copyright (C) 2011 Simplify Your Web, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

require_once dirname(__FILE__).'/vendor/Mobile_Detect.php';

class SYWUtilities 
{
	static $isMobile = null;
	
	/*
	 * Determines if the device is mobile
	 */
	static function isMobile($use_joomla_library = false)
	{
		if (!isset(self::$isMobile)) {
			
			if ($use_joomla_library) {
				jimport('joomla.environment.browser');
				$browser = JBrowser::getInstance();
				self::$isMobile = $browser->isMobile();
			} else {				
				$detect = new SYW_Mobile_Detect;
				self::$isMobile = $detect->isMobile();
			}
		}
		
		return self::$isMobile;
	}
	
	/*
	 * DEPRECATED
	 * Returns the google font found in a font family or false if none is found
	 * The returned font is of format "Google Font"
	 */
	static function googleFont($font_family) 
	{
		$google_font = false;
		
		$standard_fonts = array();
		$standard_fonts[] = "Palatino Linotype";
		$standard_fonts[] = "Book Antiqua";
		$standard_fonts[] = "MS Serif";
		$standard_fonts[] = "New York";
		$standard_fonts[] = "Times New Roman";
		$standard_fonts[] = "Arial Black";
		$standard_fonts[] = "Comic Sans MS";
		$standard_fonts[] = "Lucida Sans Unicode";
		$standard_fonts[] = "Lucida Grande";
		$standard_fonts[] = "Trebuchet MS";
		$standard_fonts[] = "MS Sans Serif";
		$standard_fonts[] = "Courier New";
		$standard_fonts[] = "Lucida Console";
		
		$fonts = explode(',', $font_family);
		foreach ($fonts as $font) {
			if (substr_count($font, '"') == 2) { // found a font with 2 quotes
				$font = trim($font, '"');
				foreach ($standard_fonts as $standard_font) {
					if (strcasecmp($standard_font, $font) == 0) { // identical fonts
						return false;
					}
				}				
				$google_font = $font;
			}
		}	
		
		return $google_font;
	}
	
	/*
	* Returns the google font found in a font family
	* The returned font is of format "Google Font"
	*/
	static function getGoogleFont($font_family)
	{
		$google_font = '';
	
		$standard_fonts = array();
		$standard_fonts[] = "Palatino Linotype";
		$standard_fonts[] = "Book Antiqua";
		$standard_fonts[] = "MS Serif";
		$standard_fonts[] = "New York";
		$standard_fonts[] = "Times New Roman";
		$standard_fonts[] = "Arial Black";
		$standard_fonts[] = "Comic Sans MS";
		$standard_fonts[] = "Lucida Sans Unicode";
		$standard_fonts[] = "Lucida Grande";
		$standard_fonts[] = "Trebuchet MS";
		$standard_fonts[] = "MS Sans Serif";
		$standard_fonts[] = "Courier New";
		$standard_fonts[] = "Lucida Console";
	
		$fonts = explode(',', $font_family);
		foreach ($fonts as $font) {
			if (substr_count($font, '"') == 2) { // found a font with 2 quotes
				$font = trim($font, '"');
				foreach ($standard_fonts as $standard_font) {
					if (strcasecmp($standard_font, $font) == 0) { // identical fonts
						return '';
					}
				}
				$google_font = $font;
			}
		}
	
		return $google_font;
	}
	
	/*
	 * Transform "Google Font" into Google+Font for use in <link> tag
	 */
	static function getSafeGoogleFont($google_font)
	{
		$font = str_replace(' ', '+', $google_font); // replace spaces by +
		return trim($font, '"');
	}
	
	/*
	 * Convert a hexa decimal color code to its RGB equivalent
	 *
	 * @param string $hexStr (hexadecimal color value)
	 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
	 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
	 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
	 */
	static function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') 
	{
	    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	    $rgbArray = array();
	    if (strlen($hexStr) == 6) { // if a proper hex code, convert using bitwise operation. No overhead... faster
	        $colorVal = hexdec($hexStr);
	        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
	        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
	        $rgbArray['blue'] = 0xFF & $colorVal;
	    } elseif (strlen($hexStr) == 3) { // if shorthand notation, need some string manipulations
	        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
	        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
	        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	    } else {
	        return false; //Invalid hex color code
	    }
	    
	    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
	} 
	
	/*
	 * Determine if the Joomla version is Joomla 3
	*/
	static function isJoomla3($and_over = false) 
	{		
		$version = new JVersion();
		$jversion = explode('.', $version->getShortVersion());
		if ($and_over) {
			if (intval($jversion[0]) > 2) { // Joomla! 3+
				return true;
			}
		} else {
			if (intval($jversion[0]) > 2 && intval($jversion[0]) < 4) { // Joomla! 3 only
				return true;
			}
		}
		
		return false;
	}
	
	/*
	 * Bootstrap conversion function (handles Bootstrap 2,3 and 4)
	 */ 
	static function getBootstrapProperty($property, $bootstrap_version = '2')
	{
	    $bootstrap_version = strval($bootstrap_version);
	    switch ($property) {
	        
	        // buttons
	        
	        case 'btn': return 'btn'; break; // exists for all versions
	        
	        case 'btn-default': // no default in B2 nor B4
	            if ($bootstrap_version == '3') { return 'btn-default'; }
	            break;
	        case 'btn-primary': return 'btn-primary'; break;
	        case 'btn-secondary': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'btn-secondary'; }
	            break;
	        case 'btn-info': return 'btn-info'; break;
	        case 'btn-warning': return 'btn-warning'; break;
	        case 'btn-danger': return 'btn-danger'; break;
	        case 'btn-success': return 'btn-success'; break;
	        case 'btn-link': return 'btn-link'; break;
	        case 'btn-inverse': // no inverse for B3 and B4
	            if ($bootstrap_version == '2') { return 'btn-inverse'; }
	            if ($bootstrap_version == '4') { return 'btn-dark'; }
	            break;
	        case 'btn-light': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'btn-light'; }
	            break;
	        case 'btn-dark': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'btn-dark'; }
	            break;
	        case 'btn-block': return 'btn-block'; break;
	        case 'btn-large':
	            if ($bootstrap_version == '2') { return 'btn-large'; } 
	            return 'btn-lg';
	            break;
	        case 'btn-small': 
	            if ($bootstrap_version == '2') { return 'btn-small'; } 
	            return 'btn-sm';
	            break;
	        case 'btn-mini': // no xs in B4
	            if ($bootstrap_version == '2') { return 'btn-mini'; }
	            if ($bootstrap_version == '3') { return 'btn-xs'; }
	            return 'btn-sm';
	            break;
	            
	        // labels    
	            
	        case 'label': 
	            if ($bootstrap_version == '2' || $bootstrap_version == '3') { return 'label'; }
	            return 'badge';
	            break;	            
	        case 'label-default': // no default in B2 nor B4
	            if ($bootstrap_version == '3') { return 'label-default'; }
	            break;
	        case 'label-primary': // no primary in B2
	            if ($bootstrap_version == '3') { return 'label-primary'; }
	            if ($bootstrap_version == '4') { return 'badge-primary'; }
	            break;
	        case 'label-secondary': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-secondary'; }
	            break;
	        case 'label-info': 
	            if ($bootstrap_version == '2' || $bootstrap_version == '3') { return 'label-info'; }
	            return 'badge-info'; 
	            break;
	        case 'label-warning': 
	            if ($bootstrap_version == '2' || $bootstrap_version == '3') { return 'label-warning'; }
	            return 'badge-warning';
	            break;
	        case 'label-important': 
	            if ($bootstrap_version == '2') { return 'label-important'; }
	            if ($bootstrap_version == '3') { return 'label-danger'; }
	            return 'badge-danger';
	            break;
	        case 'label-success': 
	            if ($bootstrap_version == '2' || $bootstrap_version == '3') { return 'label-success'; }
	            return 'badge-success';
	            break;
	        case 'label-inverse': // no inverse for B3 and B4
	            if ($bootstrap_version == '2') { return 'label-inverse'; }
	            if ($bootstrap_version == '4') { return 'badge-dark'; }
	            break;
	        case 'label-light': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-light'; }
	            break;
	        case 'label-dark': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-dark'; }
	            break;	 
	            
	        // badges-pills    
	            
	        case 'badge':
	            if ($bootstrap_version == '2' || $bootstrap_version == '3') { return 'badge'; }
	            return 'badge badge-pill';
	            break;
	        case 'badge-default': break; // no default in B2, B3 nor B4
	        case 'badge-primary': // no primary in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-primary'; }
	            break;
	        case 'badge-secondary': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-secondary'; }
	            break;
	        case 'badge-info': // not in B3
	            if ($bootstrap_version == '2' || $bootstrap_version == '4') { return 'badge-info'; }
	            break;
	        case 'badge-warning': // not in B3
	            if ($bootstrap_version == '2' || $bootstrap_version == '4') { return 'badge-warning'; }
	            break;	            
	        case 'badge-important': // not in B3
	            if ($bootstrap_version == '2') { return 'badge-important'; }
	            if ($bootstrap_version == '4') { return 'badge-danger'; }
	            break;
	        case 'badge-success': // not in B3
	            if ($bootstrap_version == '2' || $bootstrap_version == '4') { return 'badge-success'; }
	            break;
	        case 'badge-inverse': // no inverse for B3 and B4
	            if ($bootstrap_version == '2') { return 'badge-inverse'; }
	            if ($bootstrap_version == '4') { return 'badge-dark'; }
	            break;
	        case 'badge-light': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-light'; }
	            break;
	        case 'badge-dark': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'badge-dark'; }
	            break;            
	            
	        // alerts	
	        
	        case 'alert': return 'alert'; break; // exists for all versions
	        
	        case 'alert-primary': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'alert-primary'; }
	            break;
	        case 'alert-secondary': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'alert-secondary'; }
	            break;
	        case 'alert-info': return 'alert-info'; break;
	        case 'alert-success': return 'alert-success'; break;
	        case 'alert-warning': // no B2
	            if ($bootstrap_version == '3' || $bootstrap_version == '4') { return 'alert-warning'; }
	            break;
	        case 'alert-error':    
	            if ($bootstrap_version == '2') { return 'alert-error'; }
	            return 'alert-danger';
	            break;	
	        case 'alert-light': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'alert-light'; }
	            break;
	        case 'alert-dark': // not in B2 nor B3
	            if ($bootstrap_version == '4') { return 'alert-dark'; }
	            break;
	            
	        // pagination    
	            
	        case 'pagination': return 'pagination'; break; // exists for all versions
	        
	        case 'pagination-large':
	            if ($bootstrap_version == '2') { return 'pagination-large'; }
	            return 'pagination-lg';
	            break;
	        case 'pagination-small':
	            if ($bootstrap_version == '2') { return 'pagination-small'; }
	            return 'pagination-sm';
	            break;
	        case 'pagination-mini':
	            if ($bootstrap_version == '2') { return 'pagination-mini'; }
	            return 'pagination-sm';
	            break;
	            
	        case 'pagination-left': break;
	        case 'pagination-center':
	            if ($bootstrap_version == '4') { return 'justify-content-center'; }
	            break;
	        case 'pagination-right':
	            if ($bootstrap_version == '4') { return 'justify-content-end'; }
	            break;
            
	        // align
	        
	        case 'float-right':
	            if ($bootstrap_version == '4') { return 'float-right'; }
	            return 'pull-right';
	            break;
	            
	        case 'float-left':
	            if ($bootstrap_version == '4') { return 'float-left'; }
	            return 'pull-left';
	            break;
	            
	        case 'float-none':
	            if ($bootstrap_version == '4') { return 'float-none'; }
	            break;
	            
	        // clearfix exists for all versions
	    }
	    
	    return '';
	}
	
}
?>
