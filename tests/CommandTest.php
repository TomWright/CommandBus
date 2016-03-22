<?php

/**
 * The namespaces are funky in this file in order to properly
 * test CommandInterface::getCommandName() with having to rely
 * on any external Commands being created.
 */

namespace Testing\CommandTest {

    class SimpleCommand extends \TomWright\Commander\Command\Command
    {
    }

}

namespace {

    class CommandTest extends PHPUnit_Framework_TestCase
    {

        public function testGetCommandName()
        {
            $command = new \Testing\CommandTest\SimpleCommand();
            $name = $command->getCommandName();
            $this->assertEquals('Simple', $name);
        }

    }

}