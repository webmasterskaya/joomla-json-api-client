<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Model;

use Joomla\CMS\Form\FormFactoryAwareInterface;
use Joomla\CMS\Form\FormFactoryAwareTrait;
use Joomla\CMS\MVC\Model\FormBehaviorTrait;
use Joomla\CMS\MVC\Model\ListModelInterface;

abstract class ListJsonApiModel extends BaseModel implements FormFactoryAwareInterface, ListModelInterface
{
	use FormBehaviorTrait;
	use FormFactoryAwareTrait;

	public function getItems()
	{
		// TODO: Implement getItems() method.
	}
}