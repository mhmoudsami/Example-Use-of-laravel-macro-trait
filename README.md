# Example-Use-of-laravel-macro-trait
This File Demonstrate How To Use Laravel Macro Trait To Add Method To Your Classes @ Runtime
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

Now U Can Another Method At Run Time

```php
Calc::macro('subtract' , function($number , $to_subtract){
	return $number - $to_subtract;
});

// outputs 10 as expected
Calc::subtract(20 , 10);
```

# Available Methods
The Macro Trait Has Two Method "macro" Which Regiter New Method
And 'hasMacro' Which Checks To See If a macro is registerd in your class

```php
// returns true
var_dumb( Calc::hasMacro('subtract') );

// returns false
var_dumb( Calc::hasMacro('divide') );
```

# How It Work
@todo
