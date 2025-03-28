<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\Service
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla;

use Webmasterskaya\JsonApi\Client\Joomla\Exception\JsonApiClientFactoryNotFoundException;

trait JsonApiClientFactoryAwareTrait
{
	private ?JsonApiClientFactoryInterface $jsonApiClientFactory = null;

	protected function getJsonApiClientFactory(): JsonApiClientFactoryInterface
	{
		if ($this->jsonApiClientFactory)
		{
			return $this->jsonApiClientFactory;
		}

		throw new JsonApiClientFactoryNotFoundException('JSON API Client Factory not set in ' . __CLASS__);
	}

	public function setJsonApiClientFactory(JsonApiClientFactoryInterface $jsonApiClientFactory): void
	{
		$this->jsonApiClientFactory = $jsonApiClientFactory;
	}
}