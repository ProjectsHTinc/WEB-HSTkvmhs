<?php
            /* $str;
           foreach ($sms_hw as $arr) {
            $str .= $arr["title"] . ",";
             }
			 $str = trim($str, ',');
            echo $str; */
			
$sms_hw=Array
(
    [0] => stdClass Object
        (
            [title] => Home Test
            [hw_details] => MNWFVEYTEDF
            [subject_name] => Maths
        )

    [1] => stdClass Object
        (
            [title] =>  Test
            [hw_details] => y8gio89pyo9p
            [subject_name] => Science
        )

)

        foreach ($sms_hw as $value)
        {
            $a=$value->title;
		    $b=$value->hw_details;
		    $c=$value->subject_name;
       }
?>