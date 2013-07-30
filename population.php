<?php

include "node.php";

class Population
{

	public static $size = 4;
    public $nodes = new array();
    public $fit_percent = new array();
    public $fit_goal;
    public $fit_total;

	function __construct()
	{
		for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i] = NULL;
	        $this->fit_percent[$i] = 0;
	    }
	    
	    $this->fit_goal = Node::$s_size;
	    $this->fit_total = 0;
	}

	function start()
	{
	    for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i] = new Node();
	        $this->nodes[$i]->fitness = $this->calculaFitness($nodes[$i]);
	        $this->fit_total += $this->nodes[$i]->fitness;
	    }
	    for ($i = 0; $i < Population::$size; $i++)
	        $this->fit_percent[$i] = round (((float) ($this->nodes[$i]->fitness * 100)) / $this->fit_total);
	}


	function personSort( $a, $b ) {
    return $a->age == $b->age ? 0 : ( $a->age > $b->age ) ? 1 : -1;
}

	function populationSort($a,$b)
	{
		$a->fitness > $b->fitness ? 0 : 1;
	}

	function order()
	{
		usort( $this->nodes, 'populationSort');
	}

	function update()
	{
	    for ($i = 0; $i < Population::$size; $i++)
	    {
	        $this->nodes[$i]->fitness = $this->calculaFitness($nodes[$i]);
	        $this->fit_total += $this->nodes[$i]->fitness;
	    }
	    for ($i = 0; $i < Population::$size; $i++)
	        $this->fit_percent[$i] = round (((float) ($this->nodes[$i]->fitness * 100)) / $this->fit_total);
	}
}

?>