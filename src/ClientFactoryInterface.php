<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Joomla\CMS\Http\Http;
use Laminas\Diactoros\RequestFactory;
use Laminas\Diactoros\StreamFactory;
use Swis\JsonApi\Client\Client;
use Swis\JsonApi\Client\DocumentClient;
use Swis\JsonApi\Client\Interfaces\TypeMapperInterface;
use Swis\JsonApi\Client\Parsers\ResponseParser;
use Swis\JsonApi\Client\TypeMapper;

interface ClientFactoryInterface
{
	public function createClient(array $jsonApiClientConfig = []): DocumentClient;
}