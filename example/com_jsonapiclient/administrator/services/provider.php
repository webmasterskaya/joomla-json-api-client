<?php
/**
 * @package     ${NAMESPACE}
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\JsonApiClient\Administrator\Extension\Component;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientFactory;
use Webmasterskaya\JsonApi\Client\Joomla\JsonApiClientFactoryInterface;
use Webmasterskaya\JsonApi\Client\Joomla\Service\Provider\MVCFactory;

require_once JPATH_LIBRARIES . '/json-api-client/vendor/autoload.php';

return new class implements ServiceProviderInterface {

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Joomla\DI\Container  $container  The DI container.
	 */
	public function register(Container $container)
	{
		$container->set(JsonApiClientFactoryInterface::class, new JsonApiClientFactory());
		$container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\JsonApiClient'));
		$container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\JsonApiClient'));
		$container->registerServiceProvider(new RouterFactory('\\Joomla\\Component\\JsonApiClient'));

		$container->set(
			ComponentInterface::class,
			function (Container $container) {
				$component = new Component($container->get(ComponentDispatcherFactoryInterface::class));
				$component->setMVCFactory($container->get(MVCFactoryInterface::class));

				return $component;
			}
		);
	}
};