<?php

namespace APY\DataGridBundle\Tests;

require_once __DIR__.'/bootstrap.php';

use APY\DataGridBundle\Grid\Columns;

class AddColumnTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        $this->col1 = $this->createMock('APY\DataGridBundle\Grid\Column\Column');
        $this->col2 = $this->createMock('APY\DataGridBundle\Grid\Column\Column');
        $this->col3 = $this->createMock('APY\DataGridBundle\Grid\Column\Column');
        $this->newCol = $this->createMock('APY\DataGridBundle\Grid\Column\Column');
    }

    public function testAddColumnPositiveOffset()
    {
        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, 1);
        $this->assertColumnsSame(array($this->newCol, $this->col1, $this->col2, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, 2);
        $this->assertColumnsSame(array($this->col1, $this->newCol, $this->col2, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, 3);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->newCol, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, 4);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->col3, $this->newCol), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, 5);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->col3, $this->newCol), $columns);
    }

    public function testAddColumnNullOffset()
    {
        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->col3, $this->newCol), $columns);
    }

    public function testAddColumnNegativeOffset()
    {
        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, -1);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->newCol, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, -2);
        $this->assertColumnsSame(array($this->col1, $this->newCol, $this->col2, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, -3);
        $this->assertColumnsSame(array($this->newCol, $this->col1, $this->col2, $this->col3), $columns);

        $columns = $this->getBaseColumns();
        $columns->addColumn($this->newCol, -4);
        $this->assertColumnsSame(array($this->newCol, $this->col1, $this->col2, $this->col3), $columns);
    }

    protected function getBaseColumns()
    {
        $context = $this->createMock('Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface');
        $columns = new Columns($context);
        $columns->addColumn($this->col1);
        $columns->addColumn($this->col2);
        $columns->addColumn($this->col3);
        $this->assertColumnsSame(array($this->col1, $this->col2, $this->col3), $columns);
        return $columns;
    }

    private function assertColumnsSame(array $expected, Columns $columns): void
    {
        $this->assertSame($expected, iterator_to_array($columns->getIterator()));
    }
}
