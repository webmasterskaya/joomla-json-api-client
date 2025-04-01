<?php
/**
 * @package     Joomla\Component\JsonApiClient\Site\Helper
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Component\JsonApiClient\Site\Helper;

class JsonApiClientHelper
{
	public static function getClientConfig(): array
	{
		return [
			'jsonapi.base_uri' => 'http://localhost/api/index.php/v1',
			'jsonapi.options'  => [
				'headers'   => [
					'X-JOOMLA-TOKEN' => $_ENV['JOOMLA_TOKEN'],
				],
				'transport.curl' => [
					CURLOPT_VERBOSE => true,
				]
			]
		];
	}
}