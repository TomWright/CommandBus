<?php

namespace TomWright\Commander\Handler;

use TomWright\Commander\Command\CommandInterface;

interface HandlerInterface
{

    /**
     * @param mixed $command
     * @return mixed
     */
    public function handle(CommandInterface $command);

}