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

namespace APY\DataGridBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class APYDataGridExtension extends \Symfony\Component\DependencyInjection\Extension\Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        $loader->load('columns.yaml');
        $loader->load('grid.yml');

        $container->setParameter('apy_data_grid.limits', $config['limits']);
        $container->setParameter('apy_data_grid.theme', $config['theme']);
        $container->setParameter('apy_data_grid.persistence', $config['persistence']);
        $container->setParameter('apy_data_grid.no_data_message', $config['no_data_message']);
        $container->setParameter('apy_data_grid.no_result_message', $config['no_result_message']);
        $container->setParameter('apy_data_grid.actions_columns_size', $config['actions_columns_size']);
        $container->setParameter('apy_data_grid.actions_columns_title', $config['actions_columns_title']);
        $container->setParameter('apy_data_grid.pagerfanta', $config['pagerfanta']);
    }
}
