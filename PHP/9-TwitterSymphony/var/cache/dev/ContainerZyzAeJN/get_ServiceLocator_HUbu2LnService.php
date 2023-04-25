<?php

namespace ContainerZyzAeJN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_HUbu2LnService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.hUbu2Ln' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.hUbu2Ln'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'connection' => ['services', 'doctrine.dbal.default_connection', 'getDoctrine_Dbal_DefaultConnectionService', true],
        ], [
            'connection' => '?',
        ]);
    }
}
