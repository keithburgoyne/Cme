<?php

require_once 'Inquisition/admin/components/Question/HintEdit.php';
require_once 'CME/admin/components/Question/include/CMEQuestionHelper.php';

/**
 * Question hint edit page for inquisitions
 *
 * @package   CME
 * @copyright 2013-2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
abstract class CMEQuestionHintEdit extends InquisitionQuestionHintEdit
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
		$this->helper->initInternal($this->inquisition);
	}

	// }}}
	// {{{ protected function initInquisition()

	protected function initInquisition()
	{
		parent::initInquisition();

		if (!$this->inquisition instanceof InquisitionInquisition) {
			// if we got here from the question index, load the inquisition
			// from the binding as we only have one inquisition per question
			$sql = sprintf(
				'select inquisition from InquisitionInquisitionQuestionBinding
				where question = %s',
				$this->app->db->quote($this->question->id)
			);

			$inquisition_id = SwatDB::queryOne($this->app->db, $sql);

			$this->inquisition = $this->loadInquisition($inquisition_id);
		}
	}

	// }}}
	// {{{ abstract protected function getQuestionHelper()

	abstract protected function getQuestionHelper();

	// }}}

	// build phase
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		// put edit entry at the end
		$title = $this->navbar->popEntry();

		$this->helper->buildNavBar($this->navbar);

		$this->navbar->addEntry($title);
	}

	// }}}
}

?>
