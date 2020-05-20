# Test Framework

Base classes to aid with unit and integration testing

# Versions

Version 1 is compatible with PHPUnit 4 and 5.

Version 2 is compatible with PHPUnit 6.

# Unit tests

Your unit tests should extend `Skywire\TestFramework\Unit\TestCase` which will set an `objectManager` property of type `Magento\Framework\TestFramework\Unit\Helper\ObjectManager` 

# Integration Tests

Non controller integration tests should extend `Skywire\TestFramework\Integration\TestCase` which will set an `objectManager` property of type `Magento\TestFramework\ObjectManager` 

## Controller tests

Controller tests should extend `Magento\TestFramework\TestCase\AbstractController` which will set an `_objectManager` property of type `Magento\TestFramework\ObjectManager`

## Fixture Loader

Your integration tests can load entities from YAML files  

```
class CatalogTest extends Skywire\TestFramework\Integration\TestCase
{
    /**
     * @magentoDataFixture loadFixture
     */
    public function testGetProducts();
    
    public static function loadFixture()
    {
        self::loadFixtureFile(realpath(__DIR__ . '/../_files/products.yml'));
    }
}
```

```yaml
# _files/product.yml
entities:
    -   factory: \Magento\Catalog\Model\CategoryFactory
        records:
            -   name: Bar
                id: 100
                path: '1/2'
                level: 2
                parent_id: 2
                is_active: true
    -   factory: \Magento\Catalog\Model\ProductFactory
        repository: \Magento\Catalog\Model\ProductRepository
        records:
            -   id: 3000
                attribute_set_id: 4
                name: Foo
                sku: FOOSKU
                category_ids: [100]
            -   id: 3001
                attribute_set_id: 4
                name: Foo2
                sku: FOO2SKU
```

As well as entities you can also write directly to tables, which may be useful for entity relationships

```yaml
# _files/product.yml
entities:
    -   factory: \Magento\Catalog\Model\CategoryFactory
        records:
            -   name: Bar
            ...
    -   factory: \Magento\Catalog\Model\ProductFactory
        repository: \Magento\Catalog\Model\ProductRepository
        records:
            -   id: 3000
                attribute_set_id: 4
                name: Foo
                sku: FOOSKU
            ...

tables:
    -   table: catalog_category_product
        rows:
            -   category_id: 100
                product_id: 3000
                position: 10
```
