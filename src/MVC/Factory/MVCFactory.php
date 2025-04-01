<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Factory
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Factory;

use Joomla\CMS\MVC\Factory\MVCFactory as BaseMVCFactoryAlias;
use Joomla\CMS\MVC\Model\ModelInterface;
use Psr\Log\LoggerInterface;
use Webmasterskaya\JsonApi\Client\ClientAwareInterface;
use Webmasterskaya\JsonApi\Client\ClientFactoryAwareTrait;

class MVCFactory extends BaseMVCFactoryAlias
{
	use ClientFactoryAwareTrait;

	public function createModel($name, $prefix = '', array $config = []): ?ModelInterface
	{
		$model = parent::createModel($name, $prefix, $config);

		if (is_null($model))
		{
			return null;
		}

		if ($model instanceof ClientAwareInterface)
		{
			$jsonApiClientFactory = $this->getJsonApiClientFactory();
			$jsonApiClientConfig  = $model->getJsonApiClientConfig();

			$model->setJsonApiClient($jsonApiClientFactory->createClient($jsonApiClientConfig));
		}

		return $model;
	}
}