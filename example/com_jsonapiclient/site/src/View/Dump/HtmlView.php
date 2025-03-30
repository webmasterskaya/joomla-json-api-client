<?php
/**
 * @package     Joomla\Component\JsonApiClient\Site\View\Dump
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Component\JsonApiClient\Site\View\Dump;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Swis\JsonApi\Client\Interfaces\ItemInterface;

class HtmlView extends BaseHtmlView
{
	public object $item;

	public function display($tpl = null)
	{
		$this->item = $this->getModel()->getItem();

		parent::display($tpl);
	}
}