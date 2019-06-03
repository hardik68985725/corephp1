<?php

new object can be created like these ways at run time and pass into array

________________________________________________________________________________

Create saprate objects and pass those into array.

$object1 = new stdClass();
$object1->value1 = 'value1';
$object1->value2 = 'value2';

$object2 = new stdClass();
$object2->value1 = 'value1';
$object2->value2 = 'value2';

$array = array(
    $object1
    ,$object2
);
________________________________________________________________________________


Pass direct into array using json_decode function.

$array = array(
    json_decode('{
        "value1": "value1"
        ,"value2": "value2"
    }')
    ,json_decode('{
        "value1": "value1"
        ,"value2": "value2"
    }')
);

________________________________________________________________________________

Create a function which create an object for you from the array and you can pass it.

function array_to_object($array) {

    $object = new stdClass();

    if( is_array($array) == TRUE ) {
        foreach ($array as $key => $value) {
            $object->$key = $value;
        }
    } else {
        $object = $array;
    }

return $object;
}

$array = array(
    array_to_object(
        array(
            'value1' => 'value1'
            ,'value2' => 'value2'
        )
    )
    ,array_to_object(
        array(
            'value1' => 'value1'
            ,'value2' => 'value2'
        )
    )
);



________________________________________________________________________________



?>
