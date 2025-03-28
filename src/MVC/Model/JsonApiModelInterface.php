<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla\MVC\Model;

use Swis\JsonApi\Client\Interfaces\ClientInterface;

interface JsonApiModelInterface
{
	public function getClient(): ClientInterface;
}