<?php
namespace OrderService\Domain;

use Assert\Assertion;

/**
 * Class GenerateId
 * @package OrderService\Domain
 */
final class GenerateId
{
    private $id;

    private function __construct(string $uuid) {

        $this->id = $uuid;
    }

    /**
     * @param string $uuid
     * @return GenerateId
     */
    public static function fromString(string $uuid): GenerateId {
        return new static($uuid);
    }
}
