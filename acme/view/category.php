<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
    <meta name="author" content="Michael Vance">
    <link rel="stylesheet" href="/acme/css/screen.css" media="screen" type="text/css">
    <meta charset="UTF-8">
</head>

<body>
    <header id="page-header">
        <?php include('D:\Web Developement\XAMPP\htdocs\acme\library\header.php') ?>
    </header>

    <nav id="page-nav">
        <?php include('D:\Web Developement\XAMPP\htdocs\acme\library\navigation.php'); ?> 
    </nav>

    <main>
    <h1><?php echo $categoryName; ?> Products</h1>
        <?php if(isset($message)){echo $message; } ?>
        <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
    </main>


    <footer>
        <?php include('D:\Web Developement\XAMPP\htdocs\acme\library\footer.php'); ?>
    </footer>
</body>
</html>
