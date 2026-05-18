<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Abhoryo <abhoryo@free.fr>
 * (c) Stanislav Turza
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APY\DataGridBundle\Grid\Action;

interface RowActionInterface
{
    /**
     * get action title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * get action route
     *
     * @return string
     */
    public function getRoute(): string;

    /**
     * get action confirm
     *
     * @return boolean
     */
    public function getConfirm(): bool;

    /**
     * get action confirmMessage
     *
     * @return string
     */
    public function getConfirmMessage(): string;

    /**
     * get action target
     *
     * @return string
     */
    public function getTarget(): string;

    /**
     * get the action column id
     *
     * @return string
     */
    public function getColumn(): string;

    /**
     * get route parameters
     *
     * @return array
     */
    public function getRouteParameters(): array;

    /**
     * get attributes of the link
     *
     * @return array
     */
    public function getAttributes(): array;

    /**
     * get action enabled
     *
     * @return boolean
     */
    public function getEnabled(): bool;
}
