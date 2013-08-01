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

	function calculaFitness($text)
	{
	    $this->fitness = 0;
	    $size = strlen($text);
	    for ($i = 0; $i < $size; $i++)
	        for ($j = 0; $j < $size; $j++)
	            if ($this->text[$i] != $text[$j])
                    $this->fitness++;
	}
}

?>