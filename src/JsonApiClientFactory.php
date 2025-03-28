<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla;

use Joomla\CMS\Http\Http;
use Laminas\Diactoros\RequestFactory;
use Laminas\Diactoros\StreamFactory;
use Swis\JsonApi\Client\Client;
use Swis\JsonApi\Client\DocumentClient;
use Swis\JsonApi\Client\Parsers\ResponseParser;
use Swis\JsonApi\Client\TypeMapper;

class JsonApiClientFactory implements JsonApiClientFactoryInterface
{
	public function createClient(array $jsonApiClientConfig = []): DocumentClient
	{
		$http_options    = $jsonApiClientConfig['options'] ?? [];
		$http_adapters   = $jsonApiClientConfig['adapters'] ?? '';
		$default_headers = $jsonApiClientConfig['default_headers'] ?? [];
		$base_uri        = $jsonApiClientConfig['base_uri'] ?? '';
		$type_map        = $jsonApiClientConfig['type_map'] ?? [];

		$client = new Client(
			new Http($http_options, $http_adapters),
			new RequestFactory(),
			new StreamFactory()
		);

		$typeMapper = new TypeMapper();

		if (!empty($type_map))
		{
			foreach ($type_map as $type => $class)
			{
				$typeMapper->setMapping($type, $class);
			}
		}

		$client->setDefaultHeaders(array_merge(
			$client->getDefaultHeaders(),
			$default_headers
		));

		$client->setBaseUri($base_uri);

		return new DocumentClient($client, ResponseParser::create($typeMapper));
	}
}