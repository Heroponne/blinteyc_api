<?php

namespace ContainerSqZp0tH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_BqiPl9fService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.BqiPl9f' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.BqiPl9f'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'participation' => ['privates', '.errored..service_locator.BqiPl9f.App\\Entity\\Participation', NULL, 'Cannot autowire service ".service_locator.BqiPl9f": it references class "App\\Entity\\Participation" but no such service exists.'],
            'stateRepository' => ['privates', 'App\\Repository\\StateRepository', 'getStateRepositoryService', true],
        ], [
            'participation' => 'App\\Entity\\Participation',
            'stateRepository' => 'App\\Repository\\StateRepository',
        ]);
    }
}
