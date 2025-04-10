<?php

declare(strict_types=1);

namespace Webmasterskaya\JsonApi\Client\Parser;

use Swis\JsonApi\Client\ErrorCollection;
use Swis\JsonApi\Client\Exceptions\ValidationException;

/**
 * @internal
 */
class ErrorCollectionParser
{
    private ErrorParser $errorParser;

    public function __construct(ErrorParser $errorParser)
    {
        $this->errorParser = $errorParser;
    }

    /**
     * @param mixed $data
     *
     * @return \Swis\JsonApi\Client\ErrorCollection
     */
    public function parse($data): ErrorCollection
    {
		// Joomla отвечает не массивом объектов, вопреки стандартам
	    if(is_object($data)){
		    $data = [$data];
	    }

        if (!is_array($data)) {
            throw new ValidationException(sprintf('ErrorCollection MUST be an array, "%s" given.', gettype($data)));
        }
        if (count($data) === 0) {
            throw new ValidationException('ErrorCollection cannot be empty and MUST have at least one Error object.');
        }

        return new ErrorCollection(
            array_map(
                fn ($error) => $this->errorParser->parse($error),
                $data
            )
        );
    }
}
