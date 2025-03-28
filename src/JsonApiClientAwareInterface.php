<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla;

use Swis\JsonApi\Client\Interfaces\DocumentClientInterface as ClientInterface;

interface JsonApiClientAwareInterface
{
	public function setJsonApiClient(ClientInterface $jsonApiClient): void;

	public function getJsonApiClientConfig(): array;
}