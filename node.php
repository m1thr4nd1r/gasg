<?php

class Node
{
	public static const $b_size = 8;
    public $fitness;
    public $board[Node::$b_size];

	function __construct()
	{
	    for ($i = 0; $i < Node::$b_size; $i++)
	        $this->board[$i] = rand() % Node::$b_size;
	    $this->fitness = -1;
	}

	function print()
	{
	    for ($i = 0; $i < Node::$b_size; $i++)
	    {
	        for ($j = 0; $j < Node::$b_size; $j++)
	            if ($this->board[$j] == $i)
	                echo " 1 ";
	            else
	                echo " 0 ";
	        echo "\n";
	    }
	    echo "\n";
	}

	function write()
	{
	    for ($i = 0; $i < Node::$b_size; $i++)
	        echo " " . $this->board[$i] . " ";
	}
}

?>