<?php

// Pull in the NuSOAP code
require_once('./nusoap-0.9.5/lib/nusoap.php');

// Create the client instance
$client = new nusoap_client('http://localhost/server.php?wsdl',
   true);

// Check for an error
$err = $client->getError();
if ($err) {
   // Display the error
   echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
   // At this point, you know the call that follows will fail
}

// Call the CurrencyConverter SOAP method
$result = $client->call('CurrencyConverter',
   array('amount' => 123, 'rate' => 2.08));

// Check for a fault
if ($client->fault) {
   echo '<h2>Fault</h2><pre>';
   print_r($result);
   echo '</pre>';
else {
   // Check for errors
   $err = $client->getError();
   if ($err) {
      // Display the error
      echo '<h2>Error</h2><pre>' . $err . '</pre>';
   } else {
      // Display the result
      echo '<h2>Result</h2><pre>';
      print_r($result);
      echo '</pre>';
   }
}
?>