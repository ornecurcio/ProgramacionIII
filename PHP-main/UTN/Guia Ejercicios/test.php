<?php
    #for ($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++); 
    #for ($i = 1, $j = 0; $j <= 1000; $j += $i, print $i, $i++); 
    for($i = 1, $j = 0; $j <= 1000; $j += $i)
    {
        print $i;
        ?><br/>
        <?php
        $i++;
    }
?>

