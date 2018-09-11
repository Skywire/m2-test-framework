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

