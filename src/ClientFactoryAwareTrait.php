<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Service
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Webmasterskaya\JsonApi\Client\Exception\JsonApiClientFactoryNotFoundException;

trait ClientFactoryAwareTrait
{
	private ?ClientFactoryInterface $jsonApiClientFactory = null;

	protected function getJsonApiClientFactory(): ClientFactoryInterface
	{
		if ($this->jsonApiClientFactory)
		{
			return $this->jsonApiClientFactory;
		}

		throw new JsonApiClientFactoryNotFoundException('JSON API Client Factory not set in ' . __CLASS__);
	}

	public function setJsonApiClientFactory(ClientFactoryInterface $jsonApiClientFactory): void
	{
		$this->jsonApiClientFactory = $jsonApiClientFactory;
	}
}