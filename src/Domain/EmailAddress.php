<?php


namespace OrderService\Domain;

use http\Exception\InvalidArgumentException;

/**
 * Class EmailAddress
 * @package OrderService\Domain
 * @description Validate the Email Address
 */
final class EmailAddress
{
    /** @var string $emailAddress */
    private $emailAddress;

    public function __construct(string $emailAddress) {

        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a valid email', $emailAddress));
        }

        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->emailAddress;
    }

    /**
     * @param EmailAddress $emailAddress
     * @return bool
     */
    public function equals(EmailAddress $emailAddress): bool {
        return $this === $emailAddress;
    }
}
