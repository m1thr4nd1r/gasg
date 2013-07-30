<?php

class Node
{
	public static $s_size;
    public $fitness;
    public $text;

	function __construct()
	{
        $this->text = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, strlen($msg));
	    $this->fitness = -1;
	}

	function calculaFitness($individual)
	{
	    $sum = 0;
	    for ($i = 0; $i < Node::$s_size - 1; $i++)
	        for ($j = $i+1; $j < Node::$s_size; $j++)
	            if ($individual->text[$i] != $text[$i])
                    $sum++;
	    return $sum;
	}
}

?>