<?php
include "../config/database.php";

/* INSERT */
if(isset($_POST['category_name']) && !isset($_POST['update'])){

    $category_name = $_POST['category_name'];

    $sql = "INSERT INTO categories(category_name)
            VALUES(:category_name)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_name', $category_name);
    $stmt->execute();

    echo "<p>Category Added Successfully!</p>";
}

/* DELETE */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM categories WHERE category_id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "<p>Category Deleted Successfully!</p>";
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    $sql = "UPDATE categories
            SET category_name = :category_name
            WHERE category_id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':category_name', $category_name);
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    echo "<p>Category Updated Successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>

<h2>Add Category</h2>

<form method="POST">
    Category Name:
    <input type="text" name="category_name" required>
    <button type="submit">Save</button>
</form>

<h2>Update Category</h2>

<form method="POST">
    Category ID:
    <input type="number" name="category_id" required>

    New Category Name:
    <input type="text" name="category_name" required>

    <button type="submit" name="update">Update</button>
</form>

<h2>Category List</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Category Name</th>
    </tr>

<?php
$sql = "SELECT * FROM categories";
$stmt = $conn->query($sql);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
?>
<tr>
    <td><?php echo $row['category_id']; ?></td>
    <td><?php echo $row['category_name']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>