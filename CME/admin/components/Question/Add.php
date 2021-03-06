<?php

require_once 'Inquisition/admin/components/Question/Add.php';
require_once 'CME/admin/components/Question/include/CMEQuestionHelper.php';

/**
 * Question edit page for inquisitions
 *
 * @package   CME
 * @copyright 2011-2015 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class CMEQuestionAdd extends InquisitionQuestionAdd
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

		$this->helper = $this->getQuestionHelper($this->inquisition);
		$this->helper->initInternal();

		// for evaluations, hide correct option column
		if ($this->helper->isEvaluation()) {
			$view = $this->ui->getWidget('question_option_table_view');
			$correct_column = $view->getColumn('correct_option');
			$correct_column->visible = false;
		}
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
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		$this->helper->buildNavBar($this->navbar);
	}

	// }}}
}

?>
