<?php

namespace ContainerHfxEqa3;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder5c82a = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer906d1 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties81a71 = [
        
    ];

    public function getConnection()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getConnection', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getMetadataFactory', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getExpressionBuilder', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'beginTransaction', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getCache', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getCache();
    }

    public function transactional($func)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'transactional', array('func' => $func), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->transactional($func);
    }

    public function commit()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'commit', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->commit();
    }

    public function rollback()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'rollback', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getClassMetadata', array('className' => $className), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'createQuery', array('dql' => $dql), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'createNamedQuery', array('name' => $name), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'createQueryBuilder', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'flush', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'clear', array('entityName' => $entityName), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->clear($entityName);
    }

    public function close()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'close', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->close();
    }

    public function persist($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'persist', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'remove', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'refresh', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'detach', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'merge', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getRepository', array('entityName' => $entityName), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'contains', array('entity' => $entity), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getEventManager', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getConfiguration', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'isOpen', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getUnitOfWork', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getProxyFactory', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'initializeObject', array('obj' => $obj), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'getFilters', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'isFiltersStateClean', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'hasFilters', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return $this->valueHolder5c82a->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer906d1 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHolder5c82a) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder5c82a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder5c82a->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__get', ['name' => $name], $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        if (isset(self::$publicProperties81a71[$name])) {
            return $this->valueHolder5c82a->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5c82a;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder5c82a;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5c82a;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder5c82a;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__isset', array('name' => $name), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5c82a;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder5c82a;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__unset', array('name' => $name), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5c82a;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder5c82a;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__clone', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        $this->valueHolder5c82a = clone $this->valueHolder5c82a;
    }

    public function __sleep()
    {
        $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, '__sleep', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;

        return array('valueHolder5c82a');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer906d1 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer906d1;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer906d1 && ($this->initializer906d1->__invoke($valueHolder5c82a, $this, 'initializeProxy', array(), $this->initializer906d1) || 1) && $this->valueHolder5c82a = $valueHolder5c82a;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder5c82a;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder5c82a;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}
