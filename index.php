<?php
class Product {
    private $_name;
    private $_count;
    private $_price;

    public function __construct($name, $count, $price) {
        $this->_name = $name;
        $this->_count = $count;
        $this->_price = $price;
    }

    public function getName() {
        return $this->_name;
    }

    public function getCount() {
        return $this->_count;
    }

    public function getPrice() {
        return $this->_price;
    }
}

$Items = array();
$xmlFilePath = "products.xml";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addItem'])) {
        // Отримати дані з форми
        $name = $_POST["name"];
        $count = $_POST["count"];
        $price = $_POST["price"];
        $product = new Product($name, $count, $price);
        $Items[] = $product;
    } elseif (isset($_POST['buy'])) {
        $xml = new DOMDocument();
        $xml->load($xmlFilePath);
        $root = $xml->documentElement;
        $ticket = $xml->createElement("ticket");
        foreach ($Items as $item) {
            $product = $xml->createElement("product");
            $productName = $xml->createElement("Name", $item->getName());
            $product->appendChild($productName);
            $productCount = $xml->createElement("Count", $item->getCount());
            $product->appendChild($productCount);
            $productPrice = $xml->createElement("Price", $item->getPrice());
            $product->appendChild($productPrice);
            $ticket->appendChild($product);
        }
        $root->appendChild($ticket);
        $xml->save($xmlFilePath);
        echo "Ticket added successfully!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label for="count">Count:</label><br>
        <input type="number" id="count" name="count"><br><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price"><br><br>
        <input type="submit" name="addItem" value="AddItem">
        <input type="submit" name="buy" value="Buy">
    </form>
    <form action="ticket.php">
        <input type="submit" value="GetTickets">
    </form>
    <a href="ticket.php">Перейти до сторінки Tickets</a>
</body>
</html>


