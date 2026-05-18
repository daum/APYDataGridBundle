# Upgrading Grid Mapping Annotations to Attributes

Grid metadata is now read from PHP attributes instead of Doctrine annotations.
Projects should replace `@GRID\Source` and `@GRID\Column` docblock annotations with native PHP attributes.

Before:

```php
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * @GRID\Source(columns="id, type", groups={"admin"})
 */
class Product
{
    /**
     * @GRID\Column(title="Type", filterable=false)
     */
    protected $type;
}
```

After:

```php
use APY\DataGridBundle\Grid\Mapping as GRID;

#[GRID\Source(columns: ['id', 'type'], groups: ['admin'])]
class Product
{
    #[GRID\Column(title: 'Type', filterable: false)]
    protected $type;
}
```

## Rector

Rector ships annotation-to-attribute migration support. Run Rector after
updating this bundle to a version where `Column` and `Source` are native PHP
attributes. Rector needs those attribute classes in `vendor` and explicit APY
rule configuration to recognize the old docblock annotations as convertible.

Recommended order:

1. Update this bundle.
2. Run Rector before booting or deploying the application.
3. Review the diff and run the application test suite.

Install Rector in the application being upgraded:

```bash
composer require --dev rector/rector
```

Create or update `rector.php`:

```php
<?php

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;

return RectorConfig::configure()
    ->withPaths([__DIR__ . '/src'])
    ->withConfiguredRule(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute('APY\DataGridBundle\Grid\Mapping\Source'),
        new AnnotationToAttribute('APY\DataGridBundle\Grid\Mapping\Column'),
    ]);
```

Then run:

```bash
vendor/bin/rector process
```

Rector's built-in `AnnotationToAttributeRector` converts APY grid `Source` and
`Column` annotations on classes and properties once the upgraded bundle is
installed in `vendor`.
