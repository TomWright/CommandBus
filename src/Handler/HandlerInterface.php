<?php

namespace TomWright\Commander\Handler;

interface HandlerInterface
{

    /**
     * @param mixed $command
     * @return mixed
     */
    public function handle($command);

}