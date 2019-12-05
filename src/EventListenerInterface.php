<?php

namespace PHPAT\EventDispatcher;

interface EventListenerInterface
{
    public function __invoke(EventInterface $event);
}
