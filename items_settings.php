<?php 
    session_start();
    if($_SESSION['usertype'] != 1){
	header('location: index.php');
    }

    include('item.php');

	$connection = mysqli_connect('localhost', 'root', 'Djole123!', 'fotoproj');

    $image="";
    $name = "";
    $price = "";
    $text="";
    $id=0;
    $update=false;

    //save item method
	if (isset($_POST['save'])) {
        
		$name = htmlspecialchars($_POST['name']);
		$price = htmlspecialchars($_POST['price']);
        $text=htmlspecialchars($_POST['desc']);
        $image=$_FILES['image']['name'];
        $target= "images/".basename($image);
        $query="INSERT INTO items (item_name, item_price, item_text, item_image) VALUES ('$name', '$price', '$text','$image')"; 
        
        mysqli_query($connection, $query);

        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $_SESSION['message'] = "Item saved.";

            $name = "";
            $price = "";
            $text="";
        }
        else{
            $_SESSION['message'] = "Item saved, but no image added or image not saved correctly";
        }
    }

    //edit item method
    if (isset($_GET['edit'])) {
		$id = htmlspecialchars($_GET['edit']);
		$update = true;
		$record = mysqli_query($connection, "SELECT * FROM items WHERE item_id=$id");
    
		if (!empty($record) && $record != null) {
			$item = mysqli_fetch_array($record);
			$name = $item['item_name'];
            $price = $item['item_price'];
            $text=$item['item_text'];
            $image = $item['item_image'];
		}
	}

    //delete item method
    if (isset($_GET['del'])) {
        $id = htmlspecialchars($_GET['del']);
        mysqli_query($connection, "DELETE FROM items WHERE item_id=$id");

        if (isset($_GET['item_image'])) {
            $filename = htmlspecialchars($_GET['item_image']);
            $path = "images/" . $filename;

            if (is_file($path)) {
                unlink($path);
            }
        }
        $_SESSION['message'] = "Item deleted!"; 
        header('location: items_settings.php');
    }
    
    //update item method
    if (isset($_POST['update'])) {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $text =htmlspecialchars($_POST['desc']);

        if ($_FILES['image']['name'] != null && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $target = "images/" . basename($image);
            $sql = "UPDATE items SET item_name='$name', item_price ='$price', item_text='$text', item_image='$image' WHERE item_id=$id";
        }
        else {
            $sql = "UPDATE items SET item_name='$name', item_price ='$price', item_text='$text' WHERE item_id=$id";
        }

        mysqli_query($connection, $sql);

        if(!move_uploaded_file($_FILES['image']['tmp_name'],$target)) {
            $_SESSION['message'] = "Image not saved correctly";
        }    
        $_SESSION['message'] = "Item updated!"; 
        header('location: items_settings.php');
    }
?>
<html>

    <title> FotoProj-Admin Page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/table.css">
        <link rel="stylesheet" href="css/admin.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    <body>
        <!--Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top navbar-dark" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                    </button>
                <a class="navbar-brand" href="index.php">FotoProj</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php"> <span class="glyphicon glyphicon-home	
                "></span> Home</a></li>
                <li><a href="index.php#aboutus"><span class="glyphicon glyphicon-user"></span> About Us</a></li>
                <li><a href="shop.php"><span class="glyphicon glyphicon-shopping-cart"></span> Shop</a></li>
                <li><a href="index.php#contact"><span class="glyphicon glyphicon-envelope"></span> Contact Us</a></li>
            </ul>
            <!--login logout profile -->
            <?php if(!isset($_SESSION['username'])) : ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            <?php endif ?>
            <?php if(isset($_SESSION['username'])) : ?>
                <ul class="nav navbar-nav navbar-right">
                <li><a><span class='glyphicon glyphicon-user'></span><?php echo " " . $_SESSION['username']; ?></a></li>
                <?php if($_SESSION['usertype'] == 1) : ?>
                    <li class="active"><a href='items_settings.php'><span class='glyphicon glyphicon-wrench'></span>Items settings</a></li>
                <?php endif ?>
                <li><a href="index.php?logout='1'"><span class='glyphicon glyphicon-log-out'></span>LogOut</a></li>
                </ul>
            <?php endif ?>
            </div>
        </div>
        </nav>
        <!-- msg -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php
                $msg = $_SESSION['message'];
                echo "<script type='text/javascript'>alert('$msg');</script>"; 
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>
        <!-- FORM -->
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3">
            <form id="admin_form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <td><input type="text" required name="name" value="<?php echo $name; ?>"></td>
                        </tr>
                        <tr>
                            <th>Item Price(RSD)</th>
                            <td><input type="text" required name="price" value="<?php echo $price; ?>"></td>
                        </tr>
                        <tr>
                            <th>Item Description</th>
                            <td><input type="text" required name="desc" cols='40' rows ='4' value="<?php echo $text; ?>"></td>
                        </tr>
                        <tr>
                            <th>Item Image</th>
                            <td><input type="file" name="image" value='<?php echo $image; ?>'></td>
                        </tr>
                    </thead>
                </table>

                <div>
                    <?php if ($update == true) : ?>
                        <input id="submit_button" type="submit" name="update" value="Update" style="margin-left: 20%">
                    <?php else : ?>
                        <input id="submit_button" type="submit" name="save" value="Save" style="margin-left: 20%">
                    <?php endif ?>
                </div>
                <!-- msg -->
                    <?php if (isset($_SESSION['message'])): ?>
                    <div>
                        <?php 
                            $msg = $_SESSION['message'];
                            echo "<script type='text/javascript'>alert('$msg');</script>"; 
                            unset($_SESSION['message']);
                        ?>
                    </div>
                    <?php endif ?>
            </form>
            </div>
        </div>
        <!--sql table-->
        <?php $results = mysqli_query($connection, "SELECT * FROM items"); ?>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            
            <?php while ($row = mysqli_fetch_array($results)) {
                $item = new Item($row);
                ?>
                <tr>
                    <td><?php echo $item->name; ?></td>
                    <td><?php echo $item->price; ?></td>
                    <td><?php echo $item->description; ?></td>
                    <td><?php echo $item->image; ?></td>
                    <td>
                        <a href="items_settings.php?edit=<?php echo $item->id; ?>" class="edit_btn" >Edit</a>
                    </td>
                    <td>
                        <a href="items_settings.php?del=<?php echo $item->id; ?>&item_image=<?php echo $item->image; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
    </body>
</html>