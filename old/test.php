<?php 

$data = array("Apr", "Mar", "Jan", "Feb", "ddd", "aaa", "ccc");

function monthCompare($a, $b) {
    $a = strtolower($a);
    $b = strtolower($b);
    $months = array(
        'jan' => 1,
        'feb' => 2,
        'mar' => 3,
        'apr' => 4,
        'may' => 5
    );
    if($a == $b)
        return 0;
    if(!isset($months[$a]) || !isset($months[$b]))
        return $a > $b;
    return ($months[$a] > $months[$b]) ? 1 : -1;
}

usort($data, "monthCompare");

echo "<pre>";
print_r($data);

?>