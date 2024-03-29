<?php
$xmlFilePath = "products.xml";

$xml = simplexml_load_file($xmlFilePath);

if ($xml === false) {
    die('Error loading XML file');
}

echo "<h2>Tickets</h2>";

foreach ($xml->ticket as $ticket) {
    echo "<div>";
    echo "<h3>Ticket</h3>";
    foreach ($ticket->product as $product) {
        echo "<p>Name: " . $product->Name . "</p>";
        echo "<p>Count: " . $product->Count . "</p>";
        echo "<p>Price: " . $product->Price . "</p>";
    }
    echo "</div>";
}
?>