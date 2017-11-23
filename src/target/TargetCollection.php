<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\target;

/**
 * @see TargetInterface
 *
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class TargetCollection implements TargetInterface
{
    /**
     * @var Target[]
     */
    protected $targets;

    protected $ids;

    protected $types;

    public function __construct(array $targets)
    {
        $this->targets = $targets;
        $ids = [];
        $types = [];
        foreach ($targets as $target) {
            $ids[] = $target->getId();
            $types[] = $target->getType();
        }
        $this->ids = array_unique(array_filter($ids));
        $this->types = array_unique(array_filter($types));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getTarget()->getId();
    }

    public function getIds()
    {
        return $this->ids;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->getTarget()->getType();
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function getTarget()
    {
        return reset($this->targets);
    }

    /**
     * @return string
     */
    public function getUniqId()
    {
        return $this->getType() . ':' . $this->getId();
    }

    /**
     * @return bool
     */
    public function equals(TargetInterface $other)
    {
        return $this->getId() === null && $other->getId() === null
            ? !empty(array_intersect($this->types, static::takeTypes($other)))
            : !empty(array_intersect($this->ids, static::takeIds($other)));
    }

    public static function takeIds(TargetInterface $other)
    {
        return $other instanceof static ? $other->ids : [$other->getId()];
    }

    public static function takeTypes(TargetInterface $other)
    {
        return $other instanceof static ? $other->types : [$other->getType()];
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
