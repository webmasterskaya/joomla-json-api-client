<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\MVC\Factory
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla\MVC\Factory;

use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\CMS\MVC\Controller\ControllerInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ModelInterface;
use Joomla\CMS\MVC\View\ViewInterface;
use Joomla\CMS\Table\Table;
use Joomla\Input\Input;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientAwareInterface;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientFactoryAwareTrait;

class MVCFactoryWithJsonApiClient implements MVCFactoryInterface
{
	use JsonApiClientFactoryAwareTrait;

	private MVCFactoryInterface $factory;

	public function __construct(MVCFactoryInterface $factory)
	{
		$this->factory = $factory;
	}

	/**
	 * Method to load and return a controller object.
	 *
	 * @param   string                   $name    The name of the controller
	 * @param   string                   $prefix  The controller prefix
	 * @param   array                    $config  The configuration array for the controller
	 * @param   CMSApplicationInterface  $app     The app
	 * @param   Input                    $input   The input
	 *
	 * @return  \Joomla\CMS\MVC\Controller\ControllerInterface|null
	 *
	 * @throws  \Exception
	 * @since   4.0.0
	 */
	public function createController($name, $prefix, array $config, CMSApplicationInterface $app, Input $input): ?ControllerInterface
	{
		return $this->factory->createController($name, $prefix, $config, $app, $input);
	}

	/**
	 * Method to load and return a model object.
	 *
	 * @param   string  $name    The name of the model.
	 * @param   string  $prefix  Optional model prefix.
	 * @param   array   $config  Optional configuration array for the model.
	 *
	 * @return \Joomla\CMS\MVC\Model\ModelInterface|null The model object
	 *
	 * @throws \Exception
	 * @since   4.0.0
	 */
	public function createModel($name, $prefix = '', array $config = []): ?ModelInterface
	{
		$model = $this->factory->createModel($name, $prefix, $config);

		if (is_null($model))
		{
			return null;
		}

		if ($model instanceof JsonApiClientAwareInterface)
		{
			$jsonApiClientFactory = $this->getJsonApiClientFactory();
			$jsonApiClientConfig  = $model->getJsonApiClientConfig();

			$model->setJsonApiClient($jsonApiClientFactory->createClient($jsonApiClientConfig));
		}

		return $model;
	}

	/**
	 * Method to load and return a view object.
	 *
	 * @param   string  $name    The name of the view.
	 * @param   string  $prefix  Optional view prefix.
	 * @param   string  $type    Optional type of view.
	 * @param   array   $config  Optional configuration array for the view.
	 *
	 * @return  \Joomla\CMS\MVC\View\ViewInterface|null  The view object
	 *
	 * @throws  \Exception
	 * @since   4.0.0
	 */
	public function createView($name, $prefix = '', $type = '', array $config = []): ?ViewInterface
	{
		return $this->factory->createView($name, $prefix, $type, $config);
	}

	/**
	 * Method to load and return a table object.
	 *
	 * @param   string  $name    The name of the table.
	 * @param   string  $prefix  Optional table prefix.
	 * @param   array   $config  Optional configuration array for the table.
	 *
	 * @return  \Joomla\CMS\Table\Table|null  The table object
	 *
	 * @throws  \Exception
	 * @since   4.0.0
	 */
	public function createTable($name, $prefix = '', array $config = []): ?Table
	{
		return $this->factory->createTable($name, $prefix, $config);
	}
}