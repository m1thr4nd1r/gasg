<?php

include "population.php";

function processIO($value)
{
	$size = strlen($value);

    $population = new Population($size);
    
    $population->start($value);
    
    $population->order();
    
    $count = GA($population, $size) + 1;
    
    $population->pop[0]->write();
    
    echo "Geracao: " . $count . " Fitness: " . $population->pop[0]->fitness . "/n";
    
    echo "------------------------- /n  Configuracao Final /n";

    echo $population->pop[0]->text;
    
    return 0;	
}

function reproduce($parents,$size)
{
    $child = new Node();

    $c = rand($size);
    
    for ($i = 0; $i < $size; $i++)
        $child->text[$i] = ($i < $c+1)? $parents[0]->board[$i] : $parents[1]->board[$i]; 
        
    return $child;
}

function random_selection($p)
{
    $selected = array();

    while (true)
    {
        $percent = abs((float)rand()/((float)getrandmax()/100));

        if ($percent < $p->fit_percent[3])
            $selected[0] = $p->pop[3];
        else if ($percent < ($p->fit_percent[2] + $p->fit_percent[3]))  
            $selected[0] = $p->pop[2];
        else if ($percent < $p->fit_percent[1] + $p->fit_percent[2] + $p->fit_percent[3])  
            $selected[0] = $p->pop[1];
        else 
            $selected[0] = $p->pop[0];
        
        $percent = abs((float)rand()/((float)getrandmax()/100));

        if ($percent < $p->fit_percent[3])
            $selected[1] = $p->pop[3];
        else if ($percent < ($p->fit_percent[2] + $p->fit_percent[3]))  
            $selected[1] = $p->pop[2];
        else if ($percent < ($p->fit_percent[1] + $p->fit_percent[2] + $p->fit_percent[3]))  
            $selected[1] = $p->pop[1];
        else 
            $selected[1] = $p->pop[0];
        
        if ($selected[0] != $selected[1])
            return $selected;
        else
            $percent = abs((float)rand()/((float)getrandmax()/100));
    }
}

function GA($pop, $size)
{	
	do
	{
		$gen = 1;
		echo $pop->nodes[0]->text . "Geracao: " . $gen . " Fitness: " . $pop->nodes[0]->fitness . "\n";

		$new_pop = new Population($size);

		for ($i = 0; $i < Population::$size; $i++)
        {
            $parents = random_selection($p);
            $child = reproduce($parents,$size);
            
            $new_p->pop[$i] = $child;
        }

        for ($i = 0; $i < Population::$size; $i++)
            for ($j = 0; $j < $size; $j++)
            {
                $chance = (float) rand() / getrandmax();
                if($chance < 0.015) // 0.015 = Taxa de Mutação
                    $new_p->pop[$i]->text[$j] = rand($size);
            }
        
        $new_p->update();
        
        $pop = $new_p;
        
        order($pop);
        
    }while($p->pop[0]->fitness < $size);

    return $generation;
}

?>