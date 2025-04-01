<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Swis\JsonApi\Client\Interfaces\DocumentClientInterface as ClientInterface;
use Webmasterskaya\JsonApi\Client\Exception\JsonApiClientNotFoundException;

trait ClientAwareTrait
{
	/**
	 * The JSON API Client.
	 *
	 * @var ClientInterface|null
	 * @since version
	 */
	private ?ClientInterface $jsonApiClient = null;

	private array $jsonApiClientConfig = [
		'options' => [],
		'adapters' => '',
		'default_headers' => [],
		'base_uri' => '',
		'type_map' => [],
	];

	protected function getJsonApiClient(): ClientInterface
	{
		if ($this->jsonApiClient)
		{
			return $this->jsonApiClient;
		}

		throw new JsonApiClientNotFoundException('JSON API Client not set in ' . __CLASS__);
	}

	public function setJsonApiClient(ClientInterface $jsonApiClient): void
	{
		$this->jsonApiClient = $jsonApiClient;
	}

	public function getJsonApiClientConfig(): array
	{
		return $this->jsonApiClientConfig;
	}
}