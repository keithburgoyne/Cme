<?php

require_once 'Inquisition/admin/components/Question/Order.php';
require_once 'CME/admin/components/Question/include/CMEQuestionHelper.php';

/**
 * @package   CME
 * @copyright 2012-2015 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class CMEQuestionOrder extends InquisitionQuestionOrder
{
	// {{{ protected properties

	/**
	 * @var CMEQuestionHelper
	 */
	protected $helper;

	// }}}

	// init phase
	// {{{ protected function initInternal()

	protected function initInternal()
	{
		parent::initInternal();

		$this->helper = $this->getQuestionHelper();
		$this->helper->initInternal();
	}

	// }}}
	// {{{ protected function getQuestionHelper()

	protected function getQuestionHelper()
	{
		return new CMEQuestionHelper($this->app, $this->inquisition);
	}

	// }}}

	// process phase
	// {{{ protected function relocate()

	protected function relocate()
	{
		$uri = $this->helper->getRelocateURI();

		if ($uri == '') {
			parent::relocate();
		} else {
			$this->app->relocate($uri);
		}
	}

	// }}}

	// build phase
	// {{{ protected function buildForm()

	protected function buildForm()
	{
		parent::buildForm();

		$form = $this->ui->getWidget('order_form');
		$form->addHiddenField('inquisition', $this->inquisition->id);
	}

	// }}}
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		$this->helper->buildNavBar($this->navbar);
	}

	// }}}
}

?>
