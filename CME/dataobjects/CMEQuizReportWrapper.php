<?php

require_once 'SwatDB/SwatDBRecordsetWrapper.php';
require_once 'CME/dataobjects/CMEQuizReport.php';

/**
 * A recordset wrapper class for CMEQuizReport objects
 *
 * @package   CME
 * @copyright 2011-2015 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @see       CMEQuizReport
 */
class CMEQuizReportWrapper extends SwatDBRecordsetWrapper
{
	// {{{ protected function init()

	protected function init()
	{
		parent::init();
		$this->row_wrapper_class = SwatDBClassMap::get('CMEQuizReport');
		$this->index_field = 'id';
	}

	// }}}
}

?>
