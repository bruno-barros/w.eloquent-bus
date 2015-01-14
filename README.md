w.eloquent-bus
====================

Command Bus for [w.eloquent project](https://github.com/bruno-barros/w.eloquent).

[![Build Status](https://travis-ci.org/bruno-barros/w.eloquent-bus.svg)](https://travis-ci.org/bruno-barros/w.eloquent-bus)

## Installation

Update your composer: `"bruno-barros/w.eloquent-bus": "dev-master"`
 
Set the service provider: `'Weloquent\Bus\BusServiceProvider'`

Run: `composer update`

## How to use it

Create your command and handler.

	// The command. Just a DTO.
	class DoSomethingCommand {
		
		public $property = 'default value';
		
	}
	
	// On same folder, the handler.
	class DoSomethingCommandHandler implements Weloquent\Bus\Contracts\CommandHandler {
		
		public function handler($command){
			
			// do whatever you need
		
		}
		
	}

Use the trait and call the `execute` method.


	class MyClass {
	
		use Weloquent\Bus\CommanderTrait;
		
		public function myMethod()
		{
			$input = ['property' => 'some value'];
						
			$this->execute(new Your\Namespace\DoSomething, $input);
		
		}
	}

Or leave the commander handle the input if it exists on GET or POST array;

	class MyClass {
	
		use Weloquent\Bus\CommanderTrait;
		
		// From a POST
		public function myMethod()
		{						
			$this->execute(new Your\Namespace\DoSomething);
		
		}
	}

## Decorators

You can decorate the command object (DTO). 

Look:

- The decorator must implements `Weloquent\Bus\Contracts\CommandHandler`.

- The decorator should return the command object. Can be the original, or modified one.


	// Decorator
	class DecoratorCommandHandler implements Weloquent\Bus\Contracts\CommandHandler {
    		
    		public function handler($command)
    		{	
    		    // apply any modification...
    		    
    			return $command;    		
    		}
    	}


	// Decorating
	class MyClass {
	
		use Weloquent\Bus\CommanderTrait;
		
		// From a POST
		public function myMethod()
		{						
			$decorator = ['Your\Namespace\DecoratorCommandHandler'];
		
			$this->execute(new Your\Namespace\DoSomething, null, $decorator);
		
		}
	}
