<?php

class Node
{
	public $fitness;
    public $text;

	function __construct($msg)
	{
        $this->text = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, strlen($msg));
	    $this->fitness = -1;
	}

	function calculaFitness($individual)
	{
	    $sum = 0;
	    $size = count($text);
	    for ($i = 0; $i < $size - 1; $i++)
	        for ($j = $i+1; $j < $size; $j++)
	            if ($individual->text[$i] != $text[$i])
                    $sum++;
	    return $sum;
	}
}

?>