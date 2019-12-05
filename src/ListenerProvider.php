<?php

namespace PHPAT\EventDispatcher;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class ListenerProvider implements ListenerProviderInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $map = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addEventListener(string $eventClassName, string $listenerClassName): void
    {
        $this->map[$eventClassName][] = $listenerClassName;
    }

    public function getListenersForEvent(object $event): iterable
    {
        foreach ($this->map[get_class($event)] ?? [] as $listenerClassName) {
            if ($this->container->has($listenerClassName)) {
                $listeners[] = $this->container->get($listenerClassName);
            }
        }

        return $listeners ?? [];
    }
}
