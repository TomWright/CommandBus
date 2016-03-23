<?php

namespace TomWright\Commander;

use TomWright\Commander\Command\CommandInterface;
use TomWright\Commander\Handler\HandlerInterface;
use TomWright\Singleton\SingletonTrait;

class CommandBus
{

    use SingletonTrait;

    /**
     * @var string[]
     */
    protected $handlerNamespaces;

    protected function __construct()
    {
        $this->handlerNamespaces = [];
    }


    /**
     * Add a namespace in which to look for Command Handlers.
     * @param string $namespace
     */
    public function addHandlerNamespace($namespace)
    {
        $namespace = rtrim($namespace, '\\');
        $namespace = "{$namespace}\\";

        if (! in_array($namespace, $this->handlerNamespaces)) {
            $this->handlerNamespaces[] = $namespace;
        }
    }


    /**
     * Handle the specified command.
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $handlerName = $command->getCommandName() . 'Handler';

        $handlers = $this->loadHandlers($handlerName);

        foreach ($handlers as $handler) {
            $handler->handle($command);
        }
    }


    /**
     * Load the handlers by name.
     * @param string $handlerName
     * @return HandlerInterface[]
     */
    protected function loadHandlers($handlerName)
    {
        $handlers = [];

        foreach ($this->handlerNamespaces as $namespace) {
            $className = "{$namespace}{$handlerName}";
            if (class_exists($className)) {
                $handler = new $className();
                $handlers[] = $handler;
            }
        }

        return $handlers;
    }

}