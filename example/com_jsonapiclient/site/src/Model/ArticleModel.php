<?php
/**
 * @package     Joomla\Component\JsonApiClient\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Component\JsonApiClient\Site\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Component\JsonApiClient\Site\Helper\JsonApiClientHelper;
use Webmasterskaya\JsonApi\Client\MVC\Model\ItemJsonApiModel;

class ArticleModel extends ItemJsonApiModel
{
	public function __construct($config = [], MVCFactoryInterface $factory = null)
	{
		$config = array_merge_recursive($config, JsonApiClientHelper::getClientConfig());
		parent::__construct($config, $factory);
	}

	/**
	 * @throws \Exception
	 */
	protected function populateState(): void
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$pk = $app->getInput()->getInt('id');
		$this->setState('article.id', $pk);
	}

	protected function getItemRequestEndpoint($pk): string
	{
		return "/content/articles/$pk";
	}
}