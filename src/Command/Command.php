<?php

namespace TomWright\Commander\Command;

abstract class Command implements CommandInterface
{

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
}