Manipulate the query builder
============================

You can set a callback to manipulate the query builder before its execution.

## Usage

```php
<?php
...
$source->manipulateQuery($callback);

$grid->setSource($source);
...
```

## Method Source::manipulateQuery parameters

|parameter|Type|Default value|Description|
|:--:|:--|:--|:--|:--|
|callback|[\Closure](http://php.net/manual/en/functions.anonymous.php) or [callable](http://php.net/manual/en/language.types.callable.php)|null|Callback to manipulate the query. Null means no callback.|

## Callback parameters

|parameter|Type|Description|
|:--:|:--|:--|:--|:--|
|query|instance of QueryBuilder|The QueryBuilder instance before its execution|

## Examples

```php
<?php
...
$source->manipulateQuery(
    function ($query)
    {
        $query->resetDQLPart('orderBy');
    }
);

$grid->setSource($source);
...
```

If you want to pass some context parameters:

```php
<?php
...
$tableAlias = $source::TABLE_ALIAS;

$source->manipulateQuery(
    function ($query) use ($tableAlias)
    {
        $query->andWhere($tableAlias . '.active = 1');
    }
);

$grid->setSource($source);
...
```

**Warning**: You must use "andWhere" instead of "Where" statement otherwise column filtering won't work. Same thing about the order and the group (addOrder, addGroup).


## 3. Using aliased columns with manipulated or customer queries.
Sometimes you may need to use an aliased (a*b AS c) column for more complex calculations.  Using these in conjunction with the filters and other grid functionality is not difficult!  

The steps are fairly simple:

1. Manipulate or inject a query with an aliased column such as `myTable.a*myTable.b AS my_calculated_total`.
2. Create the grid column representation: 

```php
$myCol = new NumberColumn(array('id' => 'myTotal',
                                'title' => 'My Aliased Field',
                                'field' => 'my_calculated_total', // The aliased name
                                'isManualField' => true, // Indicate it is a manual (or aliased) field
                                'isAggregate' => false, // Defaults to false, set true if using aggregate func. like SUM()
                                'source' => true, // Indicates the grid should retrieve it from the source (the query)
                                ));
$grid->addColumn($myCol,10);
 
```

And you are all set.  From there you will be able to use the field as if it was any other field in the grid, filters and all!