<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Swis\JsonApi\Client\Interfaces\DocumentClientInterface;
use Swis\JsonApi\Client\Interfaces\DocumentInterface;
use Swis\JsonApi\Client\Interfaces\ItemDocumentInterface;

interface ClientInterface
{
	/**
	 * @param   string  $endpoint
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 */
	public function get(string $endpoint, array $headers = []): DocumentInterface;

	/**
	 * @param   string  $endpoint
	 * @param   mixed   $body
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 */
	public function patch(string $endpoint, mixed $body, array $headers = []): DocumentInterface;

	/**
	 * @param   string  $endpoint
	 * @param   mixed   $body
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 */
	public function post(string $endpoint, mixed $body, array $headers = []): DocumentInterface;

	/**
	 * @param   string  $endpoint
	 * @param   array   $headers
	 *
	 * @return \Swis\JsonApi\Client\Interfaces\DocumentInterface
	 */
	public function delete(string $endpoint, array $headers = []): DocumentInterface;

	/**
	 * @return string
	 */
	public function getBaseUri(): string;

	/**
	 * @param   string  $baseUri
	 */
	public function setBaseUri(string $baseUri);
}