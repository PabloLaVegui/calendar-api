<?php
namespace Lavegui\Calendar\Test\Infrastructure\Persistence\Doctrine\Mapping;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaValidator;
use Doctrine\ORM\Tools\Setup;
use Lavegui\Calendar\Config\YamlConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class DoctrineSchemaValidationTest
 * @package Lavegui\Calendar\Test\Infrastructure\Persistence\Doctrine\Mapping
 */
class DoctrineSchemaValidationTest extends TestCase
{
    const PRODUCTION_YML_CONFIG_PATH = __DIR__ . '/../../../../../src/Environment/env.yml';

    /** @test */
    public function test_valid_doctrine_schema()
    {
        $config = new YamlConfig(self::PRODUCTION_YML_CONFIG_PATH);

        $isDevMode = true;
        $mappingConfig = Setup::createYAMLMetadataConfiguration(
            $config->mappingPaths(),
            $isDevMode
        );
        $dbParams = [
            'driver' => 'pdo_sqlite',
            'memory' => true
        ];
        $entityManager = EntityManager::create($dbParams, $mappingConfig);

        $validator = new SchemaValidator($entityManager);

        $errors = $validator->validateMapping();

        $this->assertTrue(empty($errors));
    }
}
