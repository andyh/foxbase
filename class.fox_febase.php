<?php

/**
* 
*/
require_once(PATH_tslib.'class.tslib_pibase.php');

class fox_febase extends tslib_pibase
{

	function resultsBrowser() {
		$wrapArr = array(
			'browseBoxWrap' => '<div class="browseBoxWrap">|</div>',
			'showResultsWrap' => '<div class="showResultsWrap">|</div>',
			'browseLinksWrap' => '<div class="browseLinksWrap"><ul>|</ul></div>',
			'showResultsNumbersWrap' => '<span class="showResultsNumbersWrap">|</span>',
			'disabledLinkWrap' => '<li class="disabledLinkWrap">|</li>',
			'inactiveLinkWrap' => '<li class="inactiveLinkWrap">|</li>',
			'activeLinkWrap' => '<li class="activeLinkWrap">|</li>'
		);
		
		$this->internal['dontLinkActivePage'] = 1;
		$this->internal['pagefloat'] = "center";
	    $this->internal['showFirstLast'] = 1;

		// only show page links if there's enough results to warrant it
		if ($this->internal['results_at_a_time']<$this->internal['res_count']) {
			return $this->pi_list_browseresults(1,'',$wrapArr);
		} else { // just display the number of results
			return $this->pi_list_browseresults(2,'',$wrapArr);
		}
	}
	
	function noResults()
	{
		// Show No Results Template
		$tCode = $this->cObj->getSubpart($this->templateFile,'###TEMPLATE_NO_RESULTS###');
		
		// Fill in any markers with content accordingly e.g.
		// $noResMarkers = array('###TITLE###' => 'hello world');
		$noResMarkers = array();
		
		return $this->cObj->substituteMarkerArrayCached($tCode, $noResMarkers);
	}
	
	function makeMarkerArray($assocArray=array()) {
		$substArray = array();
		
		foreach ($assocArray as $key => $value) {
			$markerKey = '###ITEM_'.strtoupper($key).'###';
			
			$substArray[$markerKey] = $value;
		}
		
		return $substArray;
	}

	function makeHeaderArray($assocArray=array()) {
		$substArray = array();
		
		foreach ($assocArray as $key => $value) {
			$markerKey = '###HEAD_'.strtoupper($key).'###';
			
			$substArray[$markerKey] = $key;
		}
		
		return $substArray;
	}

	// ==========================
	// = User Related Functions =
	// ==========================
	
	function feuser_logged_in()	{
		return is_array($GLOBALS['TSFE']->fe_user->user);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/foxbase/class.fox_febase.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/foxbase/class.fox_febase.php']);
}

?>