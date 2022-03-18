<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017-2020, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\Exception;

use Exception;
use hiqdev\php\billing\ExceptionInterface;
use Throwable;

/**
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class ChargeOverlappingException extends Exception implements ExceptionInterface
{
    private $chargeID;

    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        $this->chargeID = $message;
        parent::__construct("cannot replace charge $message", $code, $previous);
    }

    public function getChargeID()
    {
        return $this->chargeID;
    }
}
