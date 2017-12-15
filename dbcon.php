<?php
// Create connection to Oracle
$connection = oci_connect("S93042", "S93042","217.173.198.136:1522/orclwh");
if (!$connection) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}
// Close the Oracle connection
oci_close($connection);
?>
