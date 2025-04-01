<?php
/**
 * @package     Joomla\Component\JsonApiClient\Site\Model
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Joomla\Component\JsonApiClient\Site\Model;

use Swis\JsonApi\Client\Item;
use Swis\JsonApi\Client\ItemDocument;
use Webmasterskaya\JsonApi\Client\MVC\Model\BaseJsonApiModel;

class AuthCodeJsonApiModel extends BaseJsonApiModel
{
	public function send($data)
	{
		$key = 'phone';
		$client = $this->getJsonApiClient();
		$document = new ItemDocument();
		$item = new Item($data);
		$item->setId($data[$key]);
		$item->setType('code');

		$document->setData($item);
		dd($client->prepareBody($document));
		$response = $client->post('https://shopdev.region-zoloto.ru/api/index.php/v2/lk/user/code/send', $document);

		dd($response);
	}

	public function check($data)
	{
		$client = $this->getJsonApiClient();
		$response = $client->post('https://shopdev.region-zoloto.ru/api/index.php/v2/');
	}

	public function getItem($pk = null)
	{

	}

	public function save($data)
	{

	}
}