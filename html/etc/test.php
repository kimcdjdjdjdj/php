<?php

    echo ord('a');
    
    
    
    function get_value($char){
    
        $get_number = ord($char) - ord('a') + 1;
    
    return $get_number;
    }
    echo'<br><br>';
    
    echo get_value('a'); 
	echo'<br><br>';
    
	
?>


<?php

    echo ord('a');
    echo'<br><br>';
    
    
    function get_value_sum($cha){
    
         
		
		
		$sum = 0;
		
		while($cha !== false){  
			
			$get_number = get_value($cha);
			$sum += $get_number;
			$cha = substr($cha, 1);
			
		}
		
		
		
    
		return $sum;
    }
    
    
	echo get_value_sum('attiude');
	echo'<br><br>';
?>

<?php
	
		
		
		
		
		
		
		
		
		
	



















?>










































