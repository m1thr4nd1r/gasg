<?php

include "node.php";

class Population
{
	public static $size = 4;
    public $nodes = array();
    public $fit_percent = array();
    public $fit_total;

	function __construct($size)
	{
		for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i] = NULL;
	        $this->fit_percent[$i] = 0;
	    }
	    
	    $this->fit_goal = $size;
	    $this->fit_total = 0;
	}

	function order()
	{
		usort($this->nodes, array("Node", "populationSort"));
	}
	
	function start($msg)
	{
	    for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i] = new Node(strlen($msg));
	        $this->nodes[$i]->calculaFitness($msg);
	        $this->fit_total += $this->nodes[$i]->fitness;
	    }
	    if ($this->fit_total != 0)
	    	for ($i = 0; $i < Population::$size; $i++)
		        $this->fit_percent[$i] = round (((float) ($this->nodes[$i]->fitness * 100)) / $this->fit_total);
	}
	
	function refresh($msg)
	{
	    for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i]->calculaFitness($msg);
	        $this->fit_total += $this->nodes[$i]->fitness;
	    }
	    if ($this->fit_total != 0)
		    for ($i = 0; $i < Population::$size; $i++)
		        $this->fit_percent[$i] = round (((float) ($this->nodes[$i]->fitness * 100)) / $this->fit_total);
	}
}

?>