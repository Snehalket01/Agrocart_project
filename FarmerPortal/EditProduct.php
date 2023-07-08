<?php
include("../Includes/db.php");
session_start();
$sessphonenumber = $_SESSION['phonenumber'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../portal_files/bootstrap.min.css">

    <title>Farmer - Insert Product</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body {
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }

        .my-form,
        .login-form {
            font-family: Raleway, sans-serif;
        }

        .my-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .my-form .row {
            margin-left: 0;
            margin-right: 0;
        }

        .login-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .login-form .row {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <main class="my-form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <?php
                            if (isset($_SESSION['phonenumber'])) {
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $getting_prod = "select * from products where product_id = $id";
                                    $run = mysqli_query($con, $getting_prod);

                                    while ($details = mysqli_fetch_array($run)) {
                                        $product_title = $details['product_title'];
                                        $product_cat = $details['product_cat'];
                                        $product_type = $details['product_type'];
                                        $product_stock = $details['product_stock'];
                                        $product_price = $details['product_price'];
                                        $product_expiry = $details['product_expiry'];
                                        $product_desc = $details['product_desc'];
                                        $product_keywords = $details['product_keywords'];
                                        $product_delivery = $details['product_delivery'];
                                    }
                                }
                            }
                            ?>

                            <div class="card-header">
                                <h4 class="text-center font-weight-bold">Insert Your New Product <i class="fas fa-leaf"></i></h4>
                            </div>
                            <div class="card-body">
                                <form name="my-form" action="InsertProduct.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="product_title" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Title:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_title" class="form-control" name="product_title" value="<?php echo $product_title; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_stock" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Stock (In kg):</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_stock" class="form-control" name="product_stock" value="<?php echo $product_stock; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_cat" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Category:</label>
                                        <div class="col-md-6">
                                            <select name="product_cat" required>
                                                <option>Select a Category</option>
                                                <?php
                                                $get_cats = "select * from categories";
                                                $run_cats = mysqli_query($con, $get_cats);
                                                while ($row_cats = mysqli_fetch_array($run_cats)) {
                                                    $cat_id = $row_cats['cat_id'];
                                                    $cat_title = $row_cats['cat_title'];
                                                    echo "<option value='$cat_id'>$cat_title</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_type" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Type:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_type" class="form-control" name="product_type" placeholder="Example: potato" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_expiry" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Expiry Date:</label>
                                        <div class="col-md-6">
                                            <input id="product_expiry" class="form-control" type="date" name="product_expiry" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_image" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Image:</label>
                                        <div class="col-md-6">
                                            <input id="product_image" type="file" name="product_image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_price" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Price (Per kg):</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_price" class="form-control" name="product_price" placeholder="Enter Product price" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_desc" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Description:</label>
                                        <div class="col-md-6">
                                            <textarea id="product_desc" class="form-control" name="product_desc" rows="3" required><?php echo $product_desc; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="formIt seems there was a partial cut-off of the code you provided. However, I have made some corrections and improvements based on the available code. Here's the modified code:

```php
<?php
include("../Includes/db.php");
session_start();
$sessphonenumber = $_SESSION['phonenumber'];

if (isset($_SESSION['phonenumber']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $getting_prod = "SELECT * FROM products WHERE product_id = $id";
    $run = mysqli_query($con, $getting_prod);

    while ($details = mysqli_fetch_array($run)) {
        $product_title = $details['product_title'];
        $product_stock = $details['product_stock'];
        $product_desc = $details['product_desc'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c587fc1763.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../portal_files/bootstrap.min.css">

    <title>Farmer - Insert Product</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body {
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }

        .my-form,
        .login-form {
            font-family: Raleway, sans-serif;
        }

        .my-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .my-form .row {
            margin-left: 0;
            margin-right: 0;
        }

        .login-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .login-form .row {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <main class="my-form">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center font-weight-bold">Insert Your New Product <i class="fas fa-leaf"></i></h4>
                            </div>
                            <div class="card-body">
                                <form name="my-form" action="InsertProduct.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="product_title" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Title:</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_title" class="form-control" name="product_title" value="<?php echo isset($product_title) ? $product_title : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_stock" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Stock (In kg):</label>
                                        <div class="col-md-6">
                                            <input type="text" id="product_stock" class="form-control" name="product_stock" value="<?php echo isset($product_stock) ? $product_stock : ''; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="product_desc" class="col-md-4 col-form-label text-md-right text-center font-weight-bolder">Product Description:</label>
                                        <div class="col-md-6">
                                            <textarea id="product_desc" class="form-control" name="product_desc" rows="3" required><?php echo isset($product_desc) ? $product_desc : ''; ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Other form fields... -->

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="insert_pro">
                                            INSERT
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
