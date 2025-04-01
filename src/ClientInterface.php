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

interface ClientInterface extends DocumentClientInterface
{
	public function patch(string $endpoint, \JsonSerializable $document, array $headers = []): DocumentInterface;

	public function post(string $endpoint, \JsonSerializable $document, array $headers = []): DocumentInterface;
}