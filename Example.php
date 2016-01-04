<?php

require_once 'MacroableTrait.php';

class Calc
{
	use Illuminate\Support\Traits\MacroableTrait;
	
	public static function add($int , $toadd)
	{
		return $int + $toadd;
	}
}

// helper function to print every output in p tag
function secho($code)
{
	echo "<p>$code</p>";
}

secho( Calc::add(10 , 15) );

Calc::macro('subtract' , function($number , $to_subtract){
	return $number - $to_subtract;
});

secho( Calc::subtract(10 , 15) );
