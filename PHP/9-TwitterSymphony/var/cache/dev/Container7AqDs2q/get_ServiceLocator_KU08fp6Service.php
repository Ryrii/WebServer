<?php

namespace Container7AqDs2q;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_KU08fp6Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.KU08fp6' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.KU08fp6'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'App\\Controller\\TwitterController::createPost' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController::deletePost' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController::login' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController::post' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController::signup' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'App\\Controller\\TwitterController:createPost' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController:deletePost' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController:login' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController:post' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'App\\Controller\\TwitterController:signup' => ['privates', '.service_locator.hUbu2Ln', 'get_ServiceLocator_HUbu2LnService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.y4_Zrx.', 'get_ServiceLocator_Y4Zrx_Service', true],
        ], [
            'App\\Controller\\TwitterController::createPost' => '?',
            'App\\Controller\\TwitterController::deletePost' => '?',
            'App\\Controller\\TwitterController::login' => '?',
            'App\\Controller\\TwitterController::post' => '?',
            'App\\Controller\\TwitterController::signup' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'kernel::registerContainerConfiguration' => '?',
            'App\\Controller\\TwitterController:createPost' => '?',
            'App\\Controller\\TwitterController:deletePost' => '?',
            'App\\Controller\\TwitterController:login' => '?',
            'App\\Controller\\TwitterController:post' => '?',
            'App\\Controller\\TwitterController:signup' => '?',
            'kernel:loadRoutes' => '?',
            'kernel:registerContainerConfiguration' => '?',
        ]);
    }
}
