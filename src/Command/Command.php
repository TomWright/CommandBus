<?php

namespace TomWright\Commander\Command;

abstract class Command implements CommandInterface
{

    /**
     * Determines whether or not the command has been completed successfully.
     * @var bool
     */
    protected $commandWasSuccessful = false;

    /**
     * Returns the name of the Command.
     * E.g. \Some\Namespace\EmailUserCommand => EmailUser
     * @return string
     */
    public function getCommandName()
    {
        $className = static::class;

        // Strip any namespaces from the $className.
        $lastBackslash = strrpos($className, '\\');
        if ($lastBackslash !== false) {
            $className = substr($className, $lastBackslash);
        }
        $className = ltrim($className, '\\');

        // Strip "Command" from the end of the $className.
        $commandString = 'Command';
        $commandLength = strlen($commandString);
        $classNameLength = strlen($className);
        if ($classNameLength >= $commandLength) {
            // $className is long enough to end with $commandString.
            $lastCommand = strrpos($className, $commandString);
            if ($lastCommand !== false) {
                // We know $commandString is in $className.
                $expectedCommandLocation = $classNameLength - $commandLength;
                if ($expectedCommandLocation == $lastCommand) {
                    // We know $commandString is at the end of $className.
                    $className = substr($className, 0, $expectedCommandLocation);
                }
            }
        }

        return $className;
    }

    /**
     * Sets whether or not the command has been successfully executed.
     * @param bool $successful
     * @return bool
     */
    public function setSuccessful($successful)
    {
        $this->commandWasSuccessful = ($successful == true);
    }


    /**
     * Returns whether or not the command has been successfully executed.
     * @return bool
     */
    public function wasSuccessful()
    {
        return $this->commandWasSuccessful;
    }

}