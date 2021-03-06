<?php

require_once 'SwatDB/SwatDBRecordsetWrapper.php';
require_once 'CME/dataobjects/CMECredit.php';

/**
 * A recordset wrapper class for CMECredit objects
 *
 * @package   CME
 * @copyright 2013-2015 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 * @see       CMECredit
 */
class CMECreditWrapper extends SwatDBRecordsetWrapper
{
	// {{{ protected function init()

	protected function init()
	{
		parent::init();
		$this->row_wrapper_class = SwatDBClassMap::get('CMECredit');
		$this->index_field = 'id';
	}

	// }}}
}

?>
