<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Swis\JsonApi\Client\DocumentClient;
use Swis\JsonApi\Client\Interfaces\ClientInterface as BaseClientInterface;
use Swis\JsonApi\Client\Interfaces\DocumentInterface;
use Swis\JsonApi\Client\Interfaces\ResponseParserInterface;

class Client extends DocumentClient implements ClientInterface
{
	private BaseClientInterface $client;

	public function __construct(BaseClientInterface $client, ResponseParserInterface $parser)
	{
		$this->client = $client;

		parent::__construct($client, $parser);
	}

	/**
	 * @param   string             $endpoint
	 * @param   \JsonSerializable  $body
	 * @param   array              $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 * @throws \JsonException
	 */
	public function post(string $endpoint, \JsonSerializable $body, array $headers = []): DocumentInterface
	{
		return $this->parseResponse($this->client->post($endpoint, $this->prepareBody($body), $headers));
	}

	/**
	 * @param   string             $endpoint
	 * @param   \JsonSerializable  $body
	 * @param   array              $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 * @throws \JsonException
	 */
	public function patch(string $endpoint, \JsonSerializable $body, array $headers = []): DocumentInterface
	{
		return $this->parseResponse($this->client->patch($endpoint, $this->prepareBody($body), $headers));
	}

	/**
	 * @param   \Swis\JsonApi\Client\Interfaces\ItemDocumentInterface  $body
	 *
	 * @return string
	 * @throws \JsonException
	 */
	protected function prepareBody(\JsonSerializable $body): string
	{
		return $this->sanitizeJson(json_encode($body, JSON_THROW_ON_ERROR));
	}
}