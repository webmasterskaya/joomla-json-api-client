<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Factory
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Factory;

use Joomla\CMS\MVC\Model\ModelInterface;

class ApiMVCFactory extends MVCFactory
{
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
		$model = parent::createModel($name, $prefix, $config);

		if (!$model) {
			$model = parent::createModel($name, 'Administrator', $config);
		}

		return $model;
	}

	/**
	 * Method to load and return a table object.
	 *
	 * @param   string  $name    The name of the table.
	 * @param   string  $prefix  Optional table prefix.
	 * @param   array   $config  Optional configuration array for the table.
	 *
	 * @return  \Joomla\CMS\Table\Table  The table object
	 *
	 * @since   4.0.0
	 * @throws  \Exception
	 */
	public function createTable($name, $prefix = '', array $config = [])
	{
		$table = parent::createTable($name, $prefix, $config);

		if (!$table) {
			$table = parent::createTable($name, 'Administrator', $config);
		}

		return $table;
	}
}