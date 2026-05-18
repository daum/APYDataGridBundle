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

namespace APY\DataGridBundle\Grid\Mapping;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class Column
{
    protected $metadata;
    protected $groups;

    public function __construct(...$metadata)
    {
        if (count($metadata) === 1 && isset($metadata[0]) && is_array($metadata[0])) {
            $metadata = $metadata[0];
        }

        $this->metadata = $metadata;
        $this->groups = isset($metadata['groups']) ? (array) $metadata['groups'] : array('default');
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function getGroups()
    {
        return $this->groups;
    }
}
