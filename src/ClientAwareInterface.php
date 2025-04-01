<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

interface ClientAwareInterface
{
	public function setJsonApiClient(ClientInterface $jsonApiClient): void;

	public function getJsonApiClientConfig(): array;
}