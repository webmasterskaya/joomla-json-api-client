<?php
/**
 * @package     Webmasterskaya\JsonApi\Client\Exception
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client\Exception;

use Swis\JsonApi\Client\Error;

class ResponseErrorException extends \RuntimeException
{
	public function __construct(Error $error, \Throwable $previous = null)
	{
		$message = $error->getTitle();
		$code = $error->getCode();
		parent::__construct($message, $code, $previous);
	}
}