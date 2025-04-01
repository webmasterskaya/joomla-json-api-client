<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Model;

use Joomla\CMS\MVC\Model\ItemModelInterface;
use Joomla\Utilities\ArrayHelper;

abstract class ItemJsonApiModel extends BaseModel implements ItemModelInterface
{
	/**
	 * An item.
	 *
	 * @var    null|array
	 * @since  1.6
	 */
	protected ?array $_item = null;

	/**
	 * Model context string.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected string $_context = 'group.type';

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   1.6
	 */
	protected function getStoreId(string $id = ''): string
	{
		// Compile the store id.
		return md5($id);
	}

	public function getItem($pk = null)
	{
		$pk    = (int) ($pk ?: $this->getState($this->getName() . '.id'));
		$store = $this->getStoreId($pk);

		if ($this->_item === null)
		{
			$this->_item = [];
		}

		if (!isset($this->_item[$store]))
		{
			$document = $this->getJsonApiClient()->get(
				$this->getItemRequestEndpoint($pk),
				$this->getItemRequestHeaders($pk)
			);

			if (!$document->isSuccess())
			{
				$errors = $document->getErrors()->toArray();
				throw new \RuntimeException(array_shift($errors));
			}

			$data   = $document->getData();
			$result = $data->toArray();

			if (property_exists($data, 'id'))
			{
				$result['id'] = $data->id;
			}

			$this->_item[$store] = ArrayHelper::toObject($result, \stdClass::class, false);
		}

		return $this->_item[$store];
	}

	abstract protected function getItemRequestEndpoint($pk): string;

	protected function getItemRequestHeaders(string $id = ''): array
	{
		return [];
	}
}