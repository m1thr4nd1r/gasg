<?php

class Node
{
	public $fitness;
    public $text;

	function __construct($size)
	{
		$this->text = "";
		
		for ($i = 0; $i < $size; $i++)
			$this->text .= chr(rand(32,126));
		
//         $this->text = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $size);
	    $this->fitness = -1;
	}

	function calculaFitness($text)
	{
	    $this->fitness = 0;
	    $size = strlen($this->text);
	    for ($i = 0; $i < $size; $i++)
 			if ($this->text[$i] == $text[$i])	
 				$this->fitness++;
	}
	
	function populationSort($a,$b)
	{
		return $b->fitness - $a->fitness;
	}
}

?>