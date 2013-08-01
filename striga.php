<?php

include "population.php";

function processIO($value)
{
	$population = NULL;
    
    $population = new Population($value);
    
    $population->start($value);
    
    $population->order();
    
    $count = GA($population) + 1;
    
    $population->pop[0]->write();
    echo "Geracao: " . count . " Fitness: " . $population->pop[0]->fitness . "/n";
    
    echo "------------------------- /n  Configuracao Final /n";

    echo $population->pop[0]->text;
    
    return 0;	
}

function reproduce($x,$y,$msg)
{
    $child = new Node();
    
    $size = count($msg);

    $c = rand($size);
    
    for ($i = 0; $i < $size; $i++)
        $child->text[$i] = ($i < $c+1)? $x->board[$i] : $y->board[$i]; 
        
    return $child;
}

function random_selection($p, $X, $Y)
{
    $flag = false;
    $percent_X = abs((float)rand()/((float)getrandmax()/100));
    $percent_Y = abs((float)rand()/((float)getrandmax()/100));
    
    while (!$flag)
    {
        if ($percent_X < $p->fit_percent[3])
            $X = $p->pop[3];
        else if ($percent_X < ($p->fit_percent[2] + $p->fit_percent[3]))  
            $X = $p->pop[2];
        else if ($percent_X < $p->fit_percent[1] + $p->fit_percent[2] + $p->fit_percent[3])  
            $X = $p->pop[1];
        else 
            $X = $p->pop[0];
        
        if ($percent_Y < $p->fit_percent[3])
            $Y = $p->pop[3];
        else if ($percent_Y < ($p->fit_percent[2] + $p->fit_percent[3]))  
            $Y = $p->pop[2];
        else if ($percent_Y < ($p->fit_percent[1] + $p->fit_percent[2] + $p->fit_percent[3]))  
            $Y = $p->pop[1];
        else 
            $Y = $p->pop[0];
        
        if ($X != $Y)
            $flag = true;
        else
        {
        	$percent_Y = abs((float)rand()/((float)getrandmax()/100));
            $percent_X = abs((float)rand()/((float)getrandmax()/100));
        }       
    }
}

function GA($pop, $msg)
{	
	$gen = 0;
	$mutationR = 0.015;
	$popArray = array();
	$fitnessArray = array();
	
	do
	{
		$gen++;
		echo $pop->nodes[0]->text . "Geracao: " . $gen . " Fitness: " . $pop->nodes[0]->fitness . "\n";

		$new_pop = new Population($msg);
		$child = NULL;

		for ($i = 0; $i < Population::$size; $i++)
        {
            $X = NULL;
            $Y = NULL;
            random_selection($p,$X,$Y);
            $child = reproduce($X,$Y,$msg);
            
            $new_p->pop[$i] = $child;
        }
        
        $size = count($msg);

        for ($i = 0; $i < Population::$size; $i++)
            for ($j = 0; $j < $size; $j++)
            {
                $chance = (float) rand() / getrandmax();
                if($chance < $mutationR)
                    $new_p->pop[$i]->text[$j] = rand($size);
            }
        
        $new_p->update();
        
        $pop = $new_p;
        
        order($pop);
        
    }while($p->pop[0]->fitness < $size);

    return $generation;
}

?>