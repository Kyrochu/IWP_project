<?php
    include("connection_sql.php");

    if (isset($_GET['food_id'])) 
    {
        $foodId = $_GET['food_id'];
        

        // Fetch additional details from the menu based on food_id
        $menuQuery = "SELECT * FROM menu WHERE food_id = $foodId";
        $menuResult = mysqli_query($connect, $menuQuery);

        if ($menuResult && $menuRow = mysqli_fetch_assoc($menuResult)) 
        {
            // Get other details from the form or session
            $add_on = $_GET['add_on'];
            $uid = (int)$_GET["uid"];

            // Calculate total price
            $totalPrice = $menuRow['food_price'] + $add_on;

            // Insert into cart table
            $insertQuery = "INSERT INTO cart (food_id, food_total_price, num_food , user_id) VALUES ($foodId, $totalPrice , '1' , $uid)";
            mysqli_query($connect, $insertQuery);
        }
    }
?>
