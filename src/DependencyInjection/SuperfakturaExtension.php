<?php

declare(strict_types=1);

namespace Codea\Bundle\Superfaktura\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SuperfakturaExtension extends Extension implements ExtensionInterface, PrependExtensionInterface
{
    private FileLocator $fileLocator;

    public function __construct()
    {
        $this->fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
    }

    public function prepend(ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $configs = $this->processConfiguration($configuration, $container->getExtensionConfig('superfaktura'));

        $container->prependExtensionConfig('framework', [
            'http_client' => [
                'scoped_clients' => [
                    'superfaktura.http_client' => [
                        'base_uri' => $configs['dns'],
                        'headers' => [
                            'accept' => 'application/json',
                            'Authorization' => vsprintf('SFAPI email=%s&apikey=%s&company_id=%s', $configs['credentials']),
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, $this->fileLocator);
        $loader->load('services.xml');
    }
}
