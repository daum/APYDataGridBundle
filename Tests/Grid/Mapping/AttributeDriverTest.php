<?php

namespace APY\DataGridBundle\Tests\Grid\Mapping;

use APY\DataGridBundle\Grid\Mapping as GRID;
use APY\DataGridBundle\Grid\Mapping\Driver\AttributeDriver;

class AttributeDriverTest extends \PHPUnit\Framework\TestCase
{
    public function testClassSourceControlsColumnsDefaultsAndGroupBy()
    {
        $driver = new AttributeDriver();

        $this->assertSame(array('id', 'type'), $driver->getClassColumns(AttributeDriverProduct::class, 'admin'));
        $this->assertSame(array('type'), $driver->getGroupBy(AttributeDriverProduct::class, 'admin'));

        $fields = $driver->getFieldsMetadata(AttributeDriverProduct::class, 'admin');

        $this->assertFalse($fields['id']['filterable']);
        $this->assertFalse($fields['id']['sortable']);
        $this->assertSame('Type', $fields['type']['title']);
        $this->assertFalse($fields['type']['filterable']);
        $this->assertTrue($fields['type']['sortable']);
    }

    public function testPropertyColumnMapsRelationshipFields()
    {
        $driver = new AttributeDriver();

        $fields = $driver->getFieldsMetadata(AttributeDriverProduct::class);

        $this->assertArrayHasKey('category.name', $fields);
        $this->assertSame('category.name', $fields['category.name']['id']);
        $this->assertSame('category.name', $fields['category.name']['title']);
        $this->assertTrue($fields['category.name']['source']);
    }

    public function testClassColumnCreatesNonSourceColumn()
    {
        $driver = new AttributeDriver();

        $fields = $driver->getFieldsMetadata(AttributeDriverProduct::class);

        $this->assertArrayHasKey('custom', $fields);
        $this->assertFalse($fields['custom']['source']);
        $this->assertSame('Custom', $fields['custom']['title']);
    }
}

#[GRID\Source(columns: array('id', 'type'), filterable: false, sortable: false, groups: 'admin', groupBy: array('type'))]
#[GRID\Column(id: 'custom', title: 'Custom', type: 'text')]
class AttributeDriverProduct
{
    #[GRID\Column(primary: true)]
    protected $id;

    #[GRID\Column(title: 'Type', filterable: false, groups: array('default', 'admin'))]
    protected $type;

    #[GRID\Column(field: 'category.name')]
    protected $category;
}
