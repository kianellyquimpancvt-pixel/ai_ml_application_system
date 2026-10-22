<?php
include "../config/database.php";

/* INSERT */
if(isset($_POST['product_name']) && !isset($_POST['update'])){

    $product_name = $_POST['product_name'];

    $sql = "INSERT INTO products(product_name)
            VALUES(:product_name)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_name', $product_name);
    $stmt->execute();

    echo "<p>Product Added Successfully!</p>";
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE product_id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<p>Product Deleted Successfully!</p>";
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    $sql = "UPDATE products
            SET product_name = :product_name
            WHERE product_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Product Updated Successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h2>Add Product</h2>

<form method="POST">
    Product Name:
    <input type="text" name="product_name" required>
    <button type="submit">Save</button>
</form>

<h2>Update Product</h2>

<form method="POST">
    Product ID:
    <input type="number" name="product_id" required>

    New Product Name:
    <input type="text" name="product_name" required>

    <button type="submit" name="update">Update</button>
</form>

<h2>Product List</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
    </tr>

<?php
$sql = "SELECT * FROM products";
$stmt = $conn->query($sql);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
    <td><?php echo $row['product_id']; ?></td>
    <td><?php echo $row['product_name']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
