<?php

require_once 'Admin/pages/AdminDBDelete.php';
require_once 'SwatDB/SwatDB.php';
require_once 'Admin/AdminListDependency.php';
require_once 'Admin/AdminSummaryDependency.php';

/**
 * @package   CME
 * @copyright 2013-2014 silverorange
 */
class CMECreditDelete extends AdminDBDelete
{
	// process phase
	// {{{ protected function processDBData()

	protected function processDBData()
	{
		parent::processDBData();

		$sql = 'delete from CMECredit where id in (%s);';

		$item_list = $this->getItemList('integer');
		$sql = sprintf($sql, $item_list);
		$num = SwatDB::exec($this->app->db, $sql);

		$locale = SwatI18NLocale::get();

		$message = new SwatMessage(
			sprintf(
				CME::ngettext(
					'One CME credit has been deleted.',
					'%s CME credits have been deleted.',
					$num
				),
				$locale->formatNumber($num)
			)
		);

		$this->app->messages->add($message);
	}

	// }}}

	// build phase
	// {{{ protected function buildInternal()

	protected function buildInternal()
	{
		parent::buildInternal();

		$locale = SwatI18NLocale::get();

		$item_list = $this->getItemList('integer');

		$dep = new AdminListDependency();
		$dep->setTitle('CME credit', 'CME credits');

		$sql = sprintf(
			'select CMECredit.id, CMECredit.hours, CMECreditType.title
			from CMECredit
				inner join CMECreditType on
					CMECredit.credit_type = CMECreditType.id
			where CMECredit.id in (%s)',
			$item_list
		);

		$credits = SwatDB::query($this->app->db, $sql);

		foreach ($credits as $credit) {
			$credit->status_level = AdminDependency::DELETE;
			$credit->parent = null;
			$credit->title = sprintf(
				CME::ngettext(
					'%s (%s hour)',
					'%s (%s hours)',
					$credit->hours
				),
				$credit->title,
				$locale->formatNumber($credit->hours)
			);
			$dep->entries[] = new AdminDependencyEntry($credit);
		}

		$message = $this->ui->getWidget('confirmation_message');
		$message->content = $dep->getMessage();
		$message->content_type = 'text/xml';

		if ($dep->getStatusLevelCount(AdminDependency::DELETE) === 0) {
			$this->switchToCancelButton();
		}

	}

	// }}}
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		$this->navbar->popEntries(1);

		$this->navbar->createEntry(CME::ngettext(
			'Delete CME Credit',
			'Delete CME Credits',
			count($this->items)
		);
	}

	// }}}
}

?>
