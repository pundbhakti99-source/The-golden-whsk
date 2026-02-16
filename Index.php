<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "bakery_store");

if (!$conn) {
    die("Connection failed");
}

/* Add to Cart */
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $product_id;
}

/* Search & Filter */
$search = "";
$category = "all";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

$query = "SELECT * FROM products WHERE name LIKE '%$search%'";

if ($category != "all") {
    $query .= " AND category='$category'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sweet Cravings Bakery</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Navigation -->
<nav>
    <div class="logo">Sweet Cravings 🍰</div>
    <div>
        Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
    </div>
</nav>

<!-- Header -->
<header>
    <h1>Freshly Baked Happiness</h1>
</header>

<!-- Search & Filter -->
<div class="controls">
    <form method="GET">
        <input type="text" name="search" placeholder="Search..." value="<?php echo $search; ?>">
        
        <select name="category">
            <option value="all">All</option>
            <option value="cake">Cakes</option>
            <option value="pastry">Pastries</option>
            <option value="bread">Breads</option>
        </select>

        <button type="submit">Apply</button>
    </form>
</div>

<!-- Products -->
<section class="products">

<?php
while ($row = mysqli_fetch_assoc($result)) {
?>

<div class="card">
    <img src="images/<?php echo $row['image']; ?>">
    <h3><?php echo $row['name']; ?></h3>
    <p class="price">₹<?php echo $row['price']; ?></p>

    <form method="POST">
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
</div>

<?php } ?>

</section>

<footer>
    © 2026 Sweet Cravings Bakery
</footer>

</body>
</html>
