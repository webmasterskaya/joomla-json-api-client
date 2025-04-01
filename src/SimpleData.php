<?php
/**
 * @package     Webmasterskaya\JsonApi\Client
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Illuminate\Contracts\Support\Jsonable;
use Swis\JsonApi\Client\Interfaces\DataInterface;

class SimpleData implements DataInterface, Jsonable, \JsonSerializable
{
	/**
	 * @var array
	 * @since version
	 */
	private array $data = [];

	/**
	 * Create a new Item instance.
	 *
	 * @param   array  $data
	 *
	 * @return void
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	public function toJsonApiArray(): array
	{
		return $this->data;
	}

	/**
	 * @throws \JsonException
	 */
	public function toJson($options = 0): false|string
	{
		return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR | $options);
	}

	public function jsonSerialize(): array
	{
		return $this->data;
	}
}