<?php
//require_once 'bpmn1.php';
//if (callauto("A2")=="OK") {
echo "Starting many pages module!!!<br>";
$wps = array("A2", "Χορήγηση_Βεβαίωσης_Μόνιμης_Κατοικίας"); 

foreach ($wps as $value) {
    //echo "$value <br>";
$w = "<script>window.open('http://imagnisa.labs.ihu.edu.gr/mw/BPMN/bpmn1.php?auto=1&wp=".$value."');</script>";
echo $w;
echo "Another page opened!!!<br>";

}

//$in ="A2";
//$w = "<script>window.open('http://imagnisa.labs.ihu.edu.gr/mw/BPMN/bpmn1.php?auto=1&wp=".$in."');</script>";
//echo $w;
//$in ="Χορήγηση_Βεβαίωσης_Μόνιμης_Κατοικίας";
//$w = "<script>window.open('http://imagnisa.labs.ihu.edu.gr/mw/BPMN/bpmn1.php?auto=1&wp=".$in."');</script>";
//echo $w;
//callauto("A2");
//    callauto("Χορήγηση_Βεβαίωσης_Μόνιμης_Κατοικίας");
//}

echo "finiished!!! - I opened one windiw for each wikii page to process....";
?>