<?php
/**
 * @package     Webmasterskaya\JsonApi\Client
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace Webmasterskaya\JsonApi\Client;

use Psr\Http\Message\ResponseInterface;
use Swis\JsonApi\Client\Collection;
use Swis\JsonApi\Client\ErrorCollection;
use Swis\JsonApi\Client\Interfaces\DataInterface;
use Swis\JsonApi\Client\Interfaces\DocumentInterface;
use Swis\JsonApi\Client\Jsonapi;
use Swis\JsonApi\Client\Links;
use Swis\JsonApi\Client\Meta;
use Webmasterskaya\JsonApi\Client\Exception\NotImplementedException;

class SimpleDocument implements DocumentInterface
{
	/**
	 * @var \Swis\JsonApi\Client\Interfaces\DataInterface
	 */
	protected DataInterface $data;

	public function getResponse(): ?ResponseInterface
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setResponse(?ResponseInterface $response)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function getData(): DataInterface
	{
		return $this->data;
	}

	public function setData(DataInterface $data): void
	{
		$this->data = $data;
	}

	public function getErrors(): ErrorCollection
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setErrors(ErrorCollection $errors)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function hasErrors(): bool
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function getMeta(): ?Meta
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setMeta(?Meta $meta)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function getLinks(): ?Links
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setLinks(?Links $links)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function getIncluded(): Collection
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setIncluded(Collection $included)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function getJsonapi(): ?Jsonapi
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function setJsonapi(?Jsonapi $jsonapi)
	{
		throw new NotImplementedException('Method ' . __METHOD__ . ' not implemented on class ' . __CLASS__);
	}

	public function toArray(): array
	{
		return $this->data->toJsonApiArray();
	}

	public function jsonSerialize(): DataInterface
	{
		return $this->getData();
	}
}