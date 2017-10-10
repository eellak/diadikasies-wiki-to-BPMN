<?php
echo '<script language="javascript">';
echo 'alert("I am php")';
echo '</script>';

if(!empty($_POST['dataa'])){
$data = $_POST['dataa'];
$data = urldecode($data);
$filename =  $_POST['filename'];

//$fname = mktime().".bpmn";//generates random name
$fname = $filename."_BPMN.bpmn";//generates  name

$file = fopen("diagrams/" .$fname, 'w');//creates new file
fwrite($file, $data);
fclose($file);
}

//echo '<script language="javascript">';
//echo 'alert("php finished...")';
//echo '</script>';

?>