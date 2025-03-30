<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\MVC\Factory
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla\MVC\Factory;

use Joomla\CMS\MVC\Factory\MVCFactory as BaseMVCFactoryAlias;
use Joomla\CMS\MVC\Model\ModelInterface;
use Psr\Log\LoggerInterface;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientAwareInterface;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientFactoryAwareTrait;

class MVCFactory extends BaseMVCFactoryAlias
{
	use JsonApiClientFactoryAwareTrait;

	public function createModel($name, $prefix = '', array $config = []): ?ModelInterface
	{
		$model = parent::createModel($name, $prefix, $config);

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
}