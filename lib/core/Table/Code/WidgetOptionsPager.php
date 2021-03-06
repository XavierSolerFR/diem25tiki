<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: WidgetOptionsPager.php 59328 2016-07-31 13:33:43Z lindonb $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER['SCRIPT_NAME'], basename(__FILE__)) !== false) {
	header('location: index.php');
	exit;
}

/**
 * Class Table_Code_WidgetOptionsPager
 *
 * Creates code for the pager widget of the Tablesorter code, including the code for ajax
 *
 * @package Tiki
 * @subpackage Table
 * @uses Table_Code_WidgetOptions
 */
class Table_Code_WidgetOptionsPager extends Table_Code_WidgetOptions
{

	public function getOptionArray()
	{
		$p = array();
		$pre = 'pager_';
		//add pager controls
		if (parent::$pager) {
			$p[] = $pre . 'size: ' . parent::$s['pager']['max'];
			//pager css
			$pc[] = 'container: \'ts-pager\'';
			$p[] = $this->iterate($pc, $pre . 'css: {', $this->nt3 . '}', $this->nt4, '');
			//pager selectors
			$ps[] = 'container : \'div#' . parent::$s['pager']['controls']['id'] . '\'';
			$p[] = $this->iterate($ps, $pre . 'selectors: {', $this->nt3 . '}', $this->nt4, '');
			$p[] = $pre . 'output: \'{startRow} - {endRow} / {filteredRows} ({totalRows})\'';
		}

		//ajax settings
		if (parent::$ajax) {
			$p[] = $pre . 'ajaxObject: {dataType: \'html\'}';
			$p[] = $pre . 'ajaxUrl : \'' . parent::$s['ajax']['url']['file']
				. parent::$s['ajax']['url']['query'] . '\'';
			$p[] = $pre . 'savePages: false';

			//ajax processing - this part grabs the html, usually from the smarty template file
			//first prepare code to add a row total column using the math widget if set
			if (!empty(parent::$s['math']['totals']['row'])) {
				foreach(parent::$s['math']['totals']['row'] as $math) {
					$filter = !empty($math['filter']) ? '.attr(\'data-tsmath-filter\', \'' . $math['filter'] . '\');'
						: '';
					$addcol[] = '$(r.rows).each(function(){$(this).append(\'<td data-tsmath ="row-' . $math['formula']
							. '"></td >\')' . $filter . '});';
				}
				$addcol = implode($this->nt, $addcol);
			}
			$total = !empty(parent::$s['total']) ? parent::$s['total'] : 0;
			$ap = array(
				//parse HTML string from entire page
				'var parsedpage = $.parseHTML(data), table = $(parsedpage).find(\'' . parent::$tid . '\'), r = {};',
				//extract table body rows from html returned by smarty template file
				'r.rows = $(table).find(\'tbody tr\');',
				!empty($addcol) ? $addcol : null,
				//tablesorter needs total rows
				'r.total = \'' . $total . '\';',
				//extract number of filtered rows for use in row count display
				'r.filteredRows = $(table).data(\'count\');',
				'r.headers = null;',
				//return object
				'return r;'
			);
			$p[] = $this->iterate(
				$ap,
				$pre . 'ajaxProcessing: function(data, table){',
				$this->nt3 . '}',
				$this->nt4,
				'',
				''
			);

			//customAjaxUrl: takes the url parameters generated by Tablesorter and converts to parameters that can
			//be used by Tiki
			if (!isset(parent::$s['ajax']['custom']) || parent::$s['ajax']['custom'] !== false) {
				if (parent::$usecolselector) {
					$sortkey = 'sortkey = \'sort-\' + $(\'' . parent::$tid
						. ' th:eq(\' + sortindex + \')\').attr(\'id\');';
					$filterkey = 'filterkey = \'filter-\' + $(\'' . parent::$tid
						. ' th:eq(\' + filterindex + \')\').attr(\'id\');';
				} else {
					$sortkey = 'sortkey = \'sort-\' + sortindex';
					$filterkey = 'filterkey = \'filter-\' + filterindex';
				}
				$numrows = !empty(parent::$s['ajax']['numrows']) ? parent::$s['ajax']['numrows'] : 'numrows';
				$ca = array(
					'var vars = {}, urlparams, oneparam, sort, sorts, sortindex, sortkey, filterindex, filterkey,
					offset, filtered, colfilters, extfilters, params = [], dir, newurl, p = table.config.pager,
					requiredparams;',
					//parse out url parameters
					'urlparams = url.slice(url.indexOf(\'?\') + 1).split(\'&\');',
					'for(var i = 0; i < urlparams.length; i++) {',
					'	oneparam = urlparams[i].split(\'=\');',
					'	if (oneparam[0].search(\'sort\') > -1) {',
					'		sortindex = parseInt(oneparam[0].substr(5, oneparam[0].length - 6));',
					'		' . $sortkey,
					'		vars[sortkey] = oneparam[1];',
					'	} else if (oneparam[0].search(\'filter\') > -1) {',
					'		filterindex = parseInt(oneparam[0].substr(7, oneparam[0].length - 8));',
					'		' . $filterkey,
					'		vars[filterkey] = oneparam[1];',
					'	}',
					'}',
					//map of columns keys to sort and filter server side parameters
					!empty(parent::$s['ajax']['sort']) ? 'sort = ' . json_encode(parent::$s['ajax']['sort']) . ';' : '',
					!empty(parent::$s['ajax']['colfilters'])
						? 'colfilters = ' . json_encode(parent::$s['ajax']['colfilters']) . ';' : '',
					!empty(parent::$s['ajax']['extfilters'])
						? 'extfilters = ' . json_encode(parent::$s['ajax']['extfilters']) . ';' : '',
					!empty(parent::$s['ajax']['requiredparams'])
						? 'requiredparams = ' . json_encode(parent::$s['ajax']['requiredparams']) . ';' : '',
					//iterate through url parameters
					'$.each(vars, function(key, value) {',
						//handle sort parameters
					'	if (sort && key in sort) {',
					'		value == 0 ? dir = \'_asc\' : dir = \'_desc\';',
							//add sort if not yet defined or add sort for multiple comma-separated sort parameters
					'		typeof sorts === \'undefined\' ? sorts = sort[key] + dir : sorts += \',\' + sort[key] + dir;',
					'	}',
						//handle column and external filter parameters
					'	if ($.inArray(value, extfilters) > -1) {',
					'		params.push(decodeURIComponent(value));',
					'	} else if (key in colfilters) {',
					'		colfilters[key] == value ? params.push(colfilters[key][value]) : params.push(colfilters[key]
								+ \'=\' + value);',
					'	}',
					'});',
					//convert to tiki sort param sort parameter
					'if (sorts) {',
					'	params.push(\'' . parent::$s['ajax']['sortparam'] . '=\' + sorts);',
					'}',
					//add any required params
					'if (typeof requiredparams !== \'undefined\') {',
					'	$.each(requiredparams, function(key, value) {',
					'		params.push(key + \'=\' + value);',
					'	});',
					'}',
					//offset parameter
					'offset = ((p.page * p.size) >= p.filteredRows) ? \'\' : offset = \'&'
						. parent::$s['ajax']['offset'] . '=\' + (p.page * p.size); ',
					//build url, starting with no parameters
					'newurl = url.slice(0,url.indexOf(\'?\'));',
					'newurl = newurl + \'?' . $numrows . '=\' + p.size + offset + \'&tsAjax=y\';',
					'$.each(params, function(key, value) {',
					'	newurl = newurl + \'&\' + value;',
					'});',
					'return newurl;'
				);
			} else {
				$ca = array(
					'var p = table.config.pager, offset;',
					'offset = ((p.page * p.size) >= p.filteredRows) ? \'\' : \''
						. '&' . parent::$s['ajax']['offset'] . '\' + \'=\' + (p.page * p.size);',
					'return url + \'&tsAjax=y\' + offset + \'&numrows=\' + p.size;'
				);
			}
			if (count($ca) > 0) {
				array_filter($ca);
				$p[] = $this->iterate(
					$ca,
					$pre . 'customAjaxUrl: function(table, url) {',
					$this->nt3 . '}',
					$this->nt4,
					'',
					''
				);
			}
		}
		if (count($p) > 0) {
			return $p;
		} else {
			return false;
		}
	}
}
