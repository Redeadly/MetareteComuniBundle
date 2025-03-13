<?php

use Metarete\ComuniBundle\Command\MetareteComuniLoadCommand;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @link https://symfony.com/doc/current/bundles/best_practices.html#services
 */
return static function (ContainerConfigurator $container): void {

    $container
        ->parameters()
            // ->set('metarete_comuni.param_name', 'param_value');
    ;

    $container
        ->services()
            // ->set('metarete_comuni.service_name', 'service_class')
            ->set('Metarete\ComuniBundle\Service\ComuniService', 'Metarete\ComuniBundle\Service\ComuniService')
                ->arg('$entityManager', new Reference('doctrine.orm.entity_manager'))    
                ->tag('metarete_comuni.comuni_service')
                ->public()
            ->set(MetareteComuniLoadCommand::class)
                ->arg('$entityManager', new Reference('doctrine.orm.entity_manager'))
                ->tag('console.command')
                ->public()
    ;

};
