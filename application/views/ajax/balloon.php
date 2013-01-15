<?php
$i = 1;
if(!empty($balloon)) {
    foreach($balloon as $b) {
        echo "<p>".$i.". ".$b->ho_ten."</p>";
        $i++;
    }   
} else {
    echo "Chưa có nhân viên nào!";
}
?>