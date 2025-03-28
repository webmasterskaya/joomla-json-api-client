<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla\MVC\Model;

use Joomla\CMS\MVC\Model\ItemModelInterface;

abstract class ItemJsonApiModel extends BaseJsonApiModel implements ItemModelInterface
{
	public function getItem($pk = null)
	{
		// TODO: Implement getItem() method.
	}
}