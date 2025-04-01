<?php
/**
 * @package     Joomla\Component\JsonApiClient\Site\Controller
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Component\JsonApiClient\Site\Controller;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\View\ViewInterface;
use Joomla\Utilities\IpHelper;

class ContentController extends BaseController
{
	protected $default_view = 'dump';

	/**
	 * @throws \Exception
	 */
	public function article(): ContentController
	{
		/** @var \Joomla\Component\JsonApiClient\Site\Model\AuthCodeJsonApiModel $model */
		$model = $this->getModel('AuthCode');

		$model->send(['phone' => "+79534365118", 'ip' => IpHelper::getIp()]);

		$this->input->set('model', 'Article');

		return $this->display();
	}

	protected function prepareViewModel(ViewInterface $view): void
	{
		if (!method_exists($view, 'setModel'))
		{
			return;
		}

		$modelName = $this->input->getCmd('model');

		// Get/Create the model
		if ($model = $this->getModel($modelName, '', ['base_path' => $this->basePath]))
		{
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}
	}

}