<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Service\Provider
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Service\Provider;

use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Mail\MailerFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Router\SiteRouter;
use Joomla\CMS\User\UserFactoryInterface;
use Joomla\Database\DatabaseInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Webmasterskaya\JsonApi\Client\ClientFactoryInterface;
use Webmasterskaya\JsonApi\Client\MVC\Factory\ApiMVCFactory;
use Webmasterskaya\JsonApi\Client\MVC\Factory\MVCFactory as MVCFactoryClass;

class MVCFactory implements ServiceProviderInterface
{
	/**
	 * The extension namespace
	 *
	 * @since   4.0.0
	 */
	private string $namespace;

	/**
	 * MVCFactory constructor.
	 *
	 * @since   4.0.0
	 */
	public function __construct(string $namespace)
	{
		$this->namespace = $namespace;
	}

	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container  $container  The DI container.
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function register(Container $container): void
	{
		$container->set(
			MVCFactoryInterface::class,
			function (Container $container) {
				if (Factory::getApplication()->isClient('api'))
				{
					$factory = new ApiMVCFactory($this->namespace);
				}
				else
				{
					$factory = new MVCFactoryClass($this->namespace);
				}

				$factory->setFormFactory($container->get(FormFactoryInterface::class));
				$factory->setDispatcher($container->get(DispatcherInterface::class));
				$factory->setDatabase($container->get(DatabaseInterface::class));
				$factory->setSiteRouter($container->get(SiteRouter::class));
				$factory->setCacheControllerFactory($container->get(CacheControllerFactoryInterface::class));
				$factory->setUserFactory($container->get(UserFactoryInterface::class));
				$factory->setMailerFactory($container->get(MailerFactoryInterface::class));
				$factory->setJsonApiClientFactory($container->get(ClientFactoryInterface::class));

				return $factory;
			}
		);
	}
}