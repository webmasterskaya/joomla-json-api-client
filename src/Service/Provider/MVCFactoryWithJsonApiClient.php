<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Joomla\Service\Provider
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Joomla\Service\Provider;

use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Webmasterskaya\JsonApi\Client\Joomla\MVC\Factory\MVCFactoryWithJsonApiClient as MVCFactory;

class MVCFactoryWithJsonApiClient implements ServiceProviderInterface
{
	public function register(Container $container): void
	{
		$container->set(
			MVCFactoryInterface::class,
			function (Container $container) {
				$factory = $container->get(MVCFactoryInterface::class);

				return new MVCFactory($factory);
			}
		);
	}
}