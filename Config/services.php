<?php

declare(strict_types=1);

use Mautic\CoreBundle\DependencyInjection\MauticCoreExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public();

    $excludes = [
    ];

    $services->load('MauticPlugin\\LeuchtfeuerCompanyPointsBundle\\', '../')
        ->exclude('../{'.implode(',', array_merge(MauticCoreExtension::DEFAULT_EXCLUDES, $excludes)).'}');
    $services->load('MauticPlugin\\LeuchtfeuerCompanyPointsBundle\\Entity\\', '../Entity/*Repository.php')
        ->tag(Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\ServiceRepositoryCompilerPass::REPOSITORY_SERVICE_TAG);
    $services->alias('mautic.companypoint.model.trigger', MauticPlugin\LeuchtfeuerCompanyPointsBundle\Model\CompanyTriggerModel::class);
    $services->alias('mautic.companypoint.model.triggerevent', MauticPlugin\LeuchtfeuerCompanyPointsBundle\Model\CompanyTriggerEventModel::class);
};
