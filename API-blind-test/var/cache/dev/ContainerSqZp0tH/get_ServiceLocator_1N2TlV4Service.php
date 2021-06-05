<?php

namespace ContainerSqZp0tH;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_1N2TlV4Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.1N2TlV4' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.1N2TlV4'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'serializer' => ['services', 'jms_serializer', 'getJmsSerializerService', true],
            'track' => ['privates', '.errored..service_locator.1N2TlV4.App\\Entity\\Track', NULL, 'Cannot autowire service ".service_locator.1N2TlV4": it references class "App\\Entity\\Track" but no such service exists.'],
        ], [
            'serializer' => '?',
            'track' => 'App\\Entity\\Track',
        ]);
    }
}
