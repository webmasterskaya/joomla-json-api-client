<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\MVC\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\MVC\Model;

use Joomla\CMS\Form\FormFactoryAwareInterface;
use Joomla\CMS\Form\FormFactoryAwareTrait;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\FormBehaviorTrait;
use Joomla\CMS\MVC\Model\ListModelInterface;

abstract class ListJsonApiModel extends BaseJsonApiModel implements FormFactoryAwareInterface, ListModelInterface
{
	use FormBehaviorTrait;
	use FormFactoryAwareTrait;

	protected array $cache = [];

	protected string $context;

	protected array $filter_fields = [];

	protected ?string $filterFormName = null;

	protected string $htmlFormName = 'adminForm';

	protected array $filterForbiddenList = [];

	protected array $listForbiddenList = ['select'];

	public function __construct($config = [], MVCFactoryInterface $factory = null)
	{
		parent::__construct($config, $factory);

		if(isset($config['filter_fields'])){
			$this->filter_fields = $config['filter_fields'];
		}

		if (empty($this->context)) {
			$this->context = strtolower($this->option . '.' . $this->getName());
		}
	}

	public function getActiveFilters(): array
	{
		$activeFilters = [];

		if (!empty($this->filter_fields)) {
			foreach ($this->filter_fields as $filter) {
				$filterName = 'filter.' . $filter;

				if (!empty($this->state->get($filterName)) || is_numeric($this->state->get($filterName))) {
					$activeFilters[$filter] = $this->state->get($filterName);
				}
			}
		}

		return $activeFilters;
	}
}