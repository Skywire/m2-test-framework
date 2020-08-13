<?php

/**
 * Skywire
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @package     Skywire\Sandbox\Test\Integration
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace Skywire\TestFramework\Integration;

use Magento\Framework\App\ResourceConnection;
use Magento\TestFramework\Helper\Bootstrap;
use Symfony\Component\Yaml\Yaml;

class FixtureLoader
{
    public function load(string $file)
    {
        $data = Yaml::parse(file_get_contents($file));

        if (!empty($data['entities'] ?? [])) {
            $this->loadEntities($data['entities']);
        }

        if (!empty($data['tables'] ?? [])) {
            $this->loadTables($data['tables']);
        }
    }

    /**
     * @return \Magento\Framework\ObjectManagerInterface
     */
    protected function getObjectManager() // phpcs:ignore
    {
        // phpcs:ignore
        return Bootstrap::getObjectManager(); // phpcs: ignore
    }

    /**
     * @param $data
     */
    public function loadEntities($data): void
    {
        foreach ($data ?? [] as $entity) {
            $repository = $entity['repository'] ?? null;
            if ($repository) {
                $repository = $this->getObjectManager()->get($repository); // phpcs:ignore
            }

            $factory = $entity['factory'];
            $factory = $this->getObjectManager()->create($factory); // phpcs:ignore

            foreach ($entity['records'] as $record) {
                $model = $factory->create();
                $model->isObjectNew(true);
                $model->setData($record);
                if (isset($record['id'])) {
                    $model->setId($record['id']);
                }
                if ($repository) {
                    $repository->save($model);
                } else {
                    $model->save();
                }
            }
        }
    }

    /**
     * @param $data
     */
    public function loadTables($data): void
    {
        /** @var ResourceConnection $connection */
        $connection = $this->getObjectManager()->get(ResourceConnection::class); // phpcs:ignore

        foreach ($data ?? [] as $table) {
            foreach ($table['rows'] as $row) {
                $connection->getConnection()->insert($table['table'], $row);
            }
        }
    }
}
