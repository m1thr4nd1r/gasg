<?php

		function ga($value)
		{
			echo $value;
		}

		function calculateFitness($population,$msg,&$count)
		{
			for ($i = 0; $i < strlen($msg); $i++)
				if ($population[$i] != $msg[$i])
					$count++;
		}
		
		function Pop($msg)
		{	
			$count = 0;
			$popArray = array();
			$fitnessArray = array();
			
			do
			{
				for ($i = 0; $i < 4; $i++)
				{
					$popArray[$i] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, strlen($msg));
					$fitnessArray[$i] = calculateFitness($popArray[$i],$msg,$count);
				}
		
				for ($i = 0; $i < 4; $i++){
					for ($j = 0; $j < 4; $j++){
						if ($popArray[$i] > $popArray[$j])
						{
							$aux = $popArray[$i];
							$popArray[$i] = $popArray[$j];
							$popArray[$j] = $aux;
							$aux = $fitnessArray[$i];
							$fitnessArray[$i] = $fitnessArray[$j];
							$fitnessArray[$j] = $aux;
						}
					}
				}
				echo $popArray[0] . " Geracao: " . $count . " Fitness: " . $fitnessArray[0];
			}while ($popArray[0] > 0);
				
		}  
	
