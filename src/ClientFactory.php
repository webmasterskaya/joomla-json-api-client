<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\;

use Joomla\Http\HttpFactory;
use Laminas\Diactoros\RequestFactory;
use Laminas\Diactoros\StreamFactory;
use Swis\JsonApi\Client\Client;
use Swis\JsonApi\Client\DocumentClient;
use Swis\JsonApi\Client\Parsers\ResponseParser;
use Swis\JsonApi\Client\TypeMapper;
use Webmasterskaya\JsonApi\Client\Parser\DocumentParser;

class ClientFactory implements ClientFactoryInterface
{
	public function createClient(array $jsonApiClientConfig = []): DocumentClient
	{
		$http_options    = $jsonApiClientConfig['options'] ?: [];
		$http_adapters   = $jsonApiClientConfig['adapters'] ?: 'curl';
		$default_headers = $jsonApiClientConfig['default_headers'] ?: [];
		$base_uri        = $jsonApiClientConfig['base_uri'] ?: '';
		$type_map        = $jsonApiClientConfig['type_map'] ?: [];

		$httpFactory = new HttpFactory();

		$client = new Client(
			$httpFactory->getHttp($http_options, $http_adapters),
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

		return new DocumentClient($client, new ResponseParser(DocumentParser::create($typeMapper)));
	}
}