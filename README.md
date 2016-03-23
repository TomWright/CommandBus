# Commander

[![Build Status](https://travis-ci.org/TomWright/Commander.svg?branch=master)](https://travis-ci.org/TomWright/Commander)
[![Total Downloads](https://poser.pugx.org/tomwright/commander/d/total.svg)](https://packagist.org/packages/tomwright/commander)
[![Latest Stable Version](https://poser.pugx.org/tomwright/commander/v/stable.svg)](https://packagist.org/packages/tomwright/commander)
[![Latest Unstable Version](https://poser.pugx.org/tomwright/commander/v/unstable.svg)](https://packagist.org/packages/tomwright/commander)
[![License](https://poser.pugx.org/tomwright/commander/license.svg)](https://packagist.org/packages/tomwright/commander)

## Usage

    
You need a Command and a CommandHandler.

Let's say we have a command class stored in app/commanding/command/RegisterUserCommand.php.
```php
namespace App\Commanding\Command;

class RegisterUserCommand extends \TomWright\Commander\Command\Command
{
	protected $username;
    protected $password;
    
    public function setUsername($username)
    {
    	$this->username = $username;
    }
    
    public function getUsername()
    {
    	return $this->username;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}
```

Let's also assume we have a command handler class stored in app/commanding/handler/RegisterUserHandler.php.
```php
namespace App\Commanding\Handler;

class RegisterUserHandler implements \TomWright\Commander\Handler\HandlerInterface
{   
    public function handle(\TomWright\Commander\Command\CommandInterface $command)
    {
    	echo "Registering user \"{$command->getUsername()}\" with password \"{$command->getPassword()}\".";
    }
}
```

Now we need to add a Command Handler namespace so as the CommandBus knows where to look for the handlers.
```php
$bus = \TomWright\Commander\CommandBus::getInstance();
$bus->addHandlerNamespace('\\App\\Commanding\\Handler');
```

Now whenever we want to register a new user, all we have to do is the following:
```php
$bus = \TomWright\Commander\CommandBus::getInstance();
$command = new \App\Commanding\Command\RegisterUserCommand();
$command->setUsername('Some user');
$command->setPassword('Somepassword123');
$bus->handle($command);
```