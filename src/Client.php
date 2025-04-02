<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use JsonSerializable;
use Psr\Http\Message\StreamInterface;
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
	 * @param   string  $endpoint
	 * @param   mixed   $body
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 */
	public function post(string $endpoint, mixed $body, array $headers = []): DocumentInterface
	{
		return $this->parseResponse($this->client->post($endpoint, $this->checkBody($body), $headers));
	}

	/**
	 * @param   string  $endpoint
	 * @param   mixed   $body
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 * @throws \JsonException
	 */
	public function patch(string $endpoint, mixed $body, array $headers = []): DocumentInterface
	{
		return $this->parseResponse($this->client->patch($endpoint, $body, $headers));
	}

	protected function checkBody(mixed $body): mixed
	{
		if (is_scalar($body)
			|| is_resource($body)
			|| $body instanceof StreamInterface)
		{
			return $body;
		}

		return http_build_query($body);
	}
}