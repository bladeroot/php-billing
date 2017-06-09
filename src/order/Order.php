<?php
/**
 * PHP Billing Library
 *
 * @link      https://github.com/hiqdev/php-billing
 * @package   php-billing
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\php\billing\order;

use hiqdev\php\billing\customer\CustomerInterface;

/**
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class Order implements OrderInterface
{
    /**
     * @var int|string|null
     */
    protected $id;

    /**
     * @var CustomerInterface
     */
    protected $customer;

    /**
     * @var ActionInterface[] array: actionKey => action
     */
    protected $actions = [];

    public function __construct($id, CustomerInterface $customer, array $actions = [])
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->actions = $actions;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Returns actions.
     * @return ActionInterface[] array: actionKey => action
     */
    public function getActions()
    {
        return $this->actions;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}