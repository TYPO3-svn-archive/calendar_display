<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Fabien Udriot
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * View helper for rendering script
 *
 * = Examples =
 */
class Tx_CalendarDisplay_ViewHelpers_ScriptViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Inject JS file in the header code.
	 *
	 * @param mixed $src String filename or array of filenames
	 * @param bool $cache If true, file(s) is cached
	 * @param bool $concat If true, files are concatenated (makes sense if $file is array)
	 * @param bool $compress If true, files are compressed using JSPacker
	 * @param bool $forceOnTop
	 * @return string
	 */
	public function render($src=NULL, $cache=FALSE, $concat=FALSE, $compress=FALSE, $forceOnTop = FALSE) {

		if ($src === NULL) {
			$content = $this->renderChildren();
			/** @var $pagerender t3lib_pagerenderer */
			$pagerender = $GLOBALS['TSFE']->getPageRenderer();
			$pagerender->addJsInlineCode(md5($content), $content, $compress, $forceOnTop);
		} else if (is_array($src)) {
			foreach ($src as $file) {
				$file = $this->resolvePath($file);
				$tag = $this->getTag($file);
				$GLOBALS['TSFE']->additionalHeaderData[md5($file)] = $tag;
			}
		} else {
			$file = $this->resolvePath($src);
			$tag = $this->getTag($file);
			$GLOBALS['TSFE']->additionalHeaderData[md5($file)] = $tag;
		}
		return NULL;
	}

	/**
	 * Generate the tag
	 *
	 * @param string $file
	 * @return string
	 */
	protected function getTag($file) {
		$file = t3lib_div::createVersionNumberedFilename($file);
		$tag = '<script src="' . htmlspecialchars($file) . '" type="text/javascript"></script>';
		return $tag;
	}

	/**
	 * Resolves the path
	 *
	 * @param string $filename
	 * @return string
	 */
	protected function resolvePath($filename) {
		if (substr($filename, 0, 4) == 'EXT:') { // extension
			list($extKey, $local) = explode('/', substr($filename, 4), 2);
			$filename = '';
			if (strcmp($extKey, '') && t3lib_extMgm::isLoaded($extKey) && strcmp($local, '')) {
				$filename = t3lib_extMgm::siteRelPath($extKey) . $local;
			}
		}
		return $filename;
	}
}
?>