<?php

include "population.php";

function processIO($value)
{
	$size = strlen($value);
	
    $population = new Population($size);
    
    $population->start($value);
    
    $population->order();
	
    $count = GA($population, $value, $size) + 1;
    
    return 0;	
}

function reproduce($parents,$size)
{
    $child = new Node($size);

    $c = rand(0,$size - 1);
    
    for ($i = 0; $i < $size; $i++)
        $child->text[$i] = ($i < $c)? $parents[0]->text[$i] : $parents[1]->text[$i]; 
        
    return $child;
}

function random_selection($p)
{
	while (true)
    {
        $percent = abs((float)rand()/((float)getrandmax()/100))/100;
		
        $value = $p->nodes[3]->fitness / $p->fit_total;
        
        if ($percent < $value)
            $selected[0] = $p->nodes[3];
        else
        {
        	$value = ($p->nodes[3]->fitness + $p->nodes[2]->fitness) / $p->fit_total;
        	
        	if ($percent < $value)
            	$selected[0] = $p->nodes[2];
        	else 
        	{
        		$value = ($p->nodes[3]->fitness + $p->nodes[2]->fitness + $p->nodes[1]->fitness) / $p->fit_total;
        		
        		if ($percent < $value)
        			$selected[0] = $p->nodes[1];
        		else 
            		$selected[0] = $p->nodes[0];
        	}
        }
        
        $percent = abs((float)rand()/((float)getrandmax()/100))/100;
        
        $value = $p->nodes[3]->fitness / $p->fit_total;
        
        if ($percent < $value)
        	$selected[1] = $p->nodes[3];
        else
        {
        	$value = ($p->nodes[3]->fitness + $p->nodes[2]->fitness) / $p->fit_total;
        	 
        	if ($percent < $value)
        		$selected[1] = $p->nodes[2];
        	else
        	{
        		$value = ($p->nodes[3]->fitness + $p->nodes[2]->fitness + $p->nodes[1]->fitness) / $p->fit_total;
        
        		if ($percent < $value)
        			$selected[1] = $p->nodes[1];
        		else
        			$selected[1] = $p->nodes[0];
        	}
        }
        
        if ($selected[0]->text != $selected[1]->text)
            return $selected;
    }
}

function printPop($node, $gen)
{
	echo $node->text . " Geracao: " . $gen . " Fitness: " . $node->fitness . "<br/>";
}

function GA($pop, $msg, $size)
{	
	$hits = -1;
	do
	{
		$gen = 1;
		
		if ($pop->nodes[0]->fitness > $hits)
		{
			printPop($pop->nodes[0],$gen);
			$hits = $pop->nodes[0]->fitness;
		}
			
		$new_pop = new Population($size);

		for ($i = 0; $i < Population::$size; $i++)
        {
            $parents = random_selection($pop);
            $child = reproduce($parents,$size); // Alguma coisa errada com o child? Muita child em branco
            
            for ($j = 0; $j < $size; $j++)
            {
            	$chance = abs((float) rand() / ((float) getrandmax() / 100));
            	if($chance <= 25) // 25% = Taxa de Mutação
            	{
            		$c = chr(rand(32,126));
            		$child->text[$j] = $c[0];
            	}
            }
            
            $new_pop->nodes[$i] = $child;
        }
        
        $new_pop->refresh($msg);
        
        $pop = $new_pop;
        
        $pop->order();
        
    }while($pop->nodes[0]->fitness != 0);
    
    echo "------------------------- \n  Configuracao Final \n";
    
    printPop($pop->nodes[0],$gen);
    
    return $generation;
}

?>