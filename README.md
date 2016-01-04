# Example-Use-of-laravel-macro-trait
This Repo Demonstrates How To Use Laravel Macro Trait To Add Methods To Your Class @ Runtime
--
# What is Laravel Macro Trait
Laravel Macro Trait Is a Utility That Gives U The Ability To add Methods To Your Class At Run Time
# Example
Import The Trait Into Your Class

```php
class Calc
{
	use Illuminate\Support\Traits\MacroableTrait;
	
	public static function add($int , $toadd)
	{
		return $int + $toadd;
	}
}

// outputs 30 as expected
Calc::add(20 , 10);
```

Now U Can Add Another Method At Run Time

```php
Calc::macro('subtract' , function($number , $to_subtract){
	return $number - $to_subtract;
});

// outputs 10 as expected
Calc::subtract(20 , 10);
```

# Available Methods
The Macro Trait Has Two Methods "macro" Which Regiters New Method
And 'hasMacro' Which Checks To See If a macro is registerd in your class

```php
// returns true
var_dump( Calc::hasMacro('subtract') );

// returns false
var_dump( Calc::hasMacro('divide') );
```

# How It Work

open up the MacroableTrait.php 
```php
	protected static $macros = array();
```
this property store a refrence to all registerd macros in the object

when u call the 'macro' method all it does is to append a new item into this array

```php
	public static function macro($name, callable $macro)
	{
		static::$macros[$name] = $macro;
	}
```
where the key is the function name and the value is the callable function

-
when you try to access a method which doesnt exist in an object .
before php throws an exception
the php engine calls a magic method on the object called (__call) or (__callStatic) if u tried to access a static method and passes the method name along with the parameters.
-
so when we did

```php
Calc::subtract(20 , 10);
```
an internal call to the __callStatic method happened.
lets see the body of this method

```php
public static function __callStatic($method, $parameters)
{
	if (static::hasMacro($method))
	{
		return call_user_func_array(static::$macros[$method], $parameters);
	}

	throw new \BadMethodCallException("Method {$method} does not exist.");
}
```
php passes the function name in this case "subtract" with the parameters (20 , 10)
the function calls the 'hasMacro' method which return a boolean value weather or not the function exist in
the macros array
if it`s found it returns the function call 
else it throws 'BadMethodCallException'
