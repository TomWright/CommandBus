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


    /**
     * Sets whether or not the command has been successfully executed.
     * @param bool $successful
     * @return bool
     */
    public function setSuccessful($successful);


    /**
     * Returns whether or not the command has been successfully executed.
     * @return bool
     */
    public function wasSuccessful();

}