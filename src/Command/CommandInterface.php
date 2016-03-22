<?php

namespace TomWright\Commander\Command;

interface CommandInterface
{

    /**
     * Returns the name of the Command.
     * E.g. EmailUserCommand => EmailUser
     * @return string
     */
    public function getCommandName();

}