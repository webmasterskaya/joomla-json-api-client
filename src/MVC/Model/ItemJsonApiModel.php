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
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param string $id A prefix for the store id.
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

    /**
     * @param null|int|string $pk
     *
     * @return object
     *
     * @throws \Exception
     * @since version
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function getItem($pk = null)
    {
        $pk = ($pk === null) ? $this->getState($this->getName() . '.id') : $pk;

        if ($pk === null) {
            throw new \InvalidArgumentException('Item `pk` cannot be null');
        }

        if (is_string($pk)) {
            $pk = trim($pk);
        }

        $store = $this->getStoreId($pk);

        if ($this->_item === null) {
            $this->_item = [];
        }

        if (isset($this->_item[$store]) && !empty($pk)) {
            return $this->_item[$store];
        }

        /** @var \Swis\JsonApi\Client\Document $document */
        $document = $this->getJsonApiClient()->get(
            $this->getItemRequestEndpoint($pk),
            $this->getItemRequestHeaders($pk),
        );

        if ($document->hasErrors()) {
            /** @var \Swis\JsonApi\Client\Error[] $errors */
            $errors = $document->getErrors()->toArray();
            $error = $errors[0];
            throw new ResponseErrorException($error);
        }

        /** @var \Swis\JsonApi\Client\ItemDocument $data */
        $data = $document->getData();
        $result = $data->toArray();

        if (property_exists($data, 'id')) {
            $result['id'] = $data->id;
        }

        $item = ArrayHelper::toObject($result, \stdClass::class, false);

        if (empty($pk) && !empty($result->id)) {
            $this->_item[$this->getStoreId($result->id)] = $item;
        }

        return $item;
    }

    /**
     * @param null|int|string $pk
     *
     * @return string
     * @throws \Exception
     * @noinspection PhpMissingParamTypeInspection
     */
    protected function getItemRequestEndpoint($pk = null): string
    {
        return rtrim('/' . strtolower($this->getName()) . '/' . $pk, '/');
    }

    protected function getItemRequestHeaders(?string $pk = null): array
    {
        return [];
    }
}