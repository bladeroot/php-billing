<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing;

/**
 * @see TargetInterface
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
abstract class AbstractTarget implements TargetInterface
{
    public function __construct($type, $id)
    {
        $this->id = $id;
        $this->type = $type;
        $this->uniqId = $type . ':' . $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUniqId()
    {
        return $this->uniqId;
    }

    /**
     * @return bool
     */
    public function equals(TargetInterface $other)
    {
        return $this->uniqId === $other->getUniqId();
    }
}
