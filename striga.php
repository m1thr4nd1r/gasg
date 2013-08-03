<?php

include "population.php";

function processIO($value)
{
	$size = strlen($value);
	
	do 
	{
	    $population = new Population($size);
	    
	    $population->start($value);
	    
	    $population->order();
	    
	}while ($population->nodes[0]->fitness == 0);
	
    $count = GA($population, $value, $size) + 1;
    
    return 0;	
}

function reproduce($parents,$size)
{
    $child = new Node($size);

    $c = rand(0,$size);
    
    for ($i = 0; $i < $size; $i++)
        $child->text[$i] = ($i < $c)? $parents[0]->text[$i] : $parents[1]->text[$i]; 
        
    return $child;
}

function random_selection($nodes)
{
//     $selected = array();

//    	$choice = rand(count($nodes));
    
//    	$selected[0] = $nodes[$choice];
   	
//     unset($nodes[$choice]);
    
//     $choice = rand(count($nodes));
    
//     $selected[1] = $nodes[$choice];

	$choice = rand(0, count($nodes) - 1);
	
	unset($nodes[$choice]);
	
	$choice = rand(0, count($nodes) - 1);
	
	unset($nodes[$choice]);
	
	return $nodes;
}

function printPop($node, $gen)
{
	echo $node->text . " Geracao: " . $gen . " Fitness: " . $node->fitness . "\n";
}

function GA($pop, $msg, $size)
{	
	do
	{
		$gen = 1;
		
		printPop($pop->nodes[0],$gen);
			
		$new_pop = new Population($size);

		for ($i = 0; $i < Population::$size; $i++)
        {
            $parents = random_selection($pop->nodes);
            $child = reproduce($parents,$size); // Alguma coisa errada com o child? Muita child em branco
            
            for ($j = 0; $j < $size; $j++)
            {
            	$chance = (float) rand() / getrandmax();
            	if($chance < 0.015) // 0.015 = Taxa de Mutação
            		$child->text[$j] = chr(rand(32,126))[0];
            }
            
            $new_pop->nodes[$i] = $child;
        }
        
        $new_pop->refresh($value);
        
        $pop = $new_pop;
        
        $pop->order();
        
    }while($pop->nodes[0]->fitness < $size);
    
    echo "------------------------- \n  Configuracao Final \n";
    
    printPop($pop->nodes[0],$gen);
    
    return $generation;
}

?>