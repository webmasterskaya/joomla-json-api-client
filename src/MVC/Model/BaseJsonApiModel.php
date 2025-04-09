<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Model;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryAwareTrait;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryServiceInterface;
use Joomla\CMS\MVC\Model\BaseModel as JoomlaBaseModel;
use Joomla\CMS\User\CurrentUserInterface;
use Joomla\CMS\User\CurrentUserTrait;
use Joomla\Event\DispatcherAwareInterface;
use Joomla\Event\DispatcherAwareTrait;
use Webmasterskaya\JsonApi\Client\ClientAwareInterface;
use Webmasterskaya\JsonApi\Client\ClientAwareTrait;

abstract class BaseJsonApiModel extends JoomlaBaseModel implements
	JsonApiModelInterface,
	DispatcherAwareInterface,
	CurrentUserInterface,
	ClientAwareInterface
{
	use ClientAwareTrait;
	use MVCFactoryAwareTrait;
	use DispatcherAwareTrait;
	use CurrentUserTrait;

	/**
	 * The URL option for the component.
	 *
	 * @var    string
	 * @since  3.0
	 */
	protected string $option;

	/**
	 * The event to trigger when cleaning cache.
	 *
	 * @var    string
	 * @since  3.0
	 */
	protected string $event_clean_cache;

	public function __construct(array $config = [], MVCFactoryInterface $factory = null)
	{
		parent::__construct($config);

		foreach ($this->jsonApiClientConfig as $key => &$value)
		{
			if (array_key_exists("jsonapi.$key", $config))
			{
				$value = $config["jsonapi.$key"];
			}
		}

		// Clean all empty options for use default values
		$this->jsonApiClientConfig = array_filter($this->jsonApiClientConfig, fn ($item) => !empty($item));

		// Guess the option from the class name (Option)Model(View).
		if (empty($this->option))
		{
			$r = null;

			if (!preg_match('/(.*)Model/i', \get_class($this), $r))
			{
				throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_GET_NAME', __METHOD__), 500);
			}

			$this->option = ComponentHelper::getComponentName($this, $r[1]);

			// Set the clean cache event
			if (isset($config['event_clean_cache']))
			{
				$this->event_clean_cache = $config['event_clean_cache'];
			}
			elseif (empty($this->event_clean_cache))
			{
				$this->event_clean_cache = 'onContentCleanCache';
			}

			if ($factory)
			{
				$this->setMVCFactory($factory);

				return;
			}

			$component = Factory::getApplication()->bootComponent($this->option);

			if ($component instanceof MVCFactoryServiceInterface)
			{
				$this->setMVCFactory($component->getMVCFactory());
			}
		}
	}

	/**
	 * Boots the component with the given name.
	 *
	 * @param   string  $component  The component name, eg. com_content.
	 *
	 * @return  ComponentInterface  The service container
	 *
	 * @throws \Exception
	 * @since   4.0.0
	 */
	protected function bootComponent(string $component): ComponentInterface
	{
		return Factory::getApplication()->bootComponent($component);
	}

	/**
	 * Method to get the model name
	 *
	 * The model name. By default parsed using the classname or it can be set
	 * by passing a $config['name'] in the class constructor
	 *
	 * @return  string  The name of the model
	 *
	 * @since   4.0.0
	 * @throws  \Exception
	 */
	public function getName(): string
	{
		if (empty($this->name)) {
			$r = null;

			if (!preg_match('/Model(.*)/i', \get_class($this), $r)) {
				throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_GET_NAME', __METHOD__), 500);
			}

			$this->name = str_replace(['\\', 'jsonapimodel', 'model'], '', strtolower($r[1]));
		}

		return $this->name;
	}
}