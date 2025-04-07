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
use Joomla\CMS\MVC\Model\FormModelInterface;

abstract class FormJsonApiModel extends BaseJsonApiModel implements FormFactoryAwareInterface, FormModelInterface
{
	use FormBehaviorTrait;
	use FormFactoryAwareTrait;
}