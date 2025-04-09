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
use Webmasterskaya\JsonApi\Client\Exception\ResponseErrorException;

abstract class ItemJsonApiModel extends BaseJsonApiModel implements ItemModelInterface
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
	 * @throws \Exception
	 * @since   1.6
	 */
	protected function getStoreId(string $id): string
	{
		// Compile the store id.
		return md5($this->getItemRequestEndpoint($id));
	}

	public function getItem(?string $pk = null)
	{
		$pk    = trim($pk ?: $this->getState($this->getName() . '.id'));
		$store = $this->getStoreId($pk);

		if ($this->_item === null)
		{
			$this->_item = [];
		}

		if (!isset($this->_item[$store]))
		{
			/** @var \Swis\JsonApi\Client\Document $document */
			$document = $this->getJsonApiClient()->get(
				$this->getItemRequestEndpoint($pk),
				$this->getItemRequestHeaders($pk)
			);

			if ($document->hasErrors())
			{
				/** @var \Swis\JsonApi\Client\Error[] $errors */
				$errors = $document->getErrors()->toArray();
				$error  = $errors[0];
				throw new ResponseErrorException($error);
			}

			/** @var \Swis\JsonApi\Client\ItemDocument $data */
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

	/**
	 * @throws \Exception
	 */
	protected function getItemRequestEndpoint(?string $pk = null): string
	{
		return rtrim('/' . strtolower($this->getName()) . '/' . $pk, '/');
	}

	protected function getItemRequestHeaders(?string $pk = null): array
	{
		return [];
	}
}