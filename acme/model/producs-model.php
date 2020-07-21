<?php
function getCategories(){
    $db = acmeConnect();
    $sql = 'SELECT categoryName, categoryId
            FROM categories
            ORDER BY categoryName ASC';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $stmt->closeCursor();
        return $categories;
        }
function addCategory($categoryName){
    $db = acmeConnect();
    $sql = 'INSERT INTO categories (categoryName)
        VALUES (:categoryName)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    //Replace the placeholders
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function addInvetoryItem($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock,
$invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
    $db = acmeConnect();
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock,
    invSize, invWeight, invLocation, categoryId, invVendor, invStyle)
        VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock,
    :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    
    // Replace the placeholders with actual values
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
// Get product information by invId<>
function getProductInfo($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $prodInfo;
   }


//Update a product.
function updateProduct($catType, $invName, $invDescription, 
$invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight,
 $invLocation, $invVendor, $invStyle, $invId) {
 $db = acmeConnect();
 $sql = 'UPDATE inventory SET invName = :invName, 
        invDescription = :invDescription, invImage = :invImg, 
        invThumbnail = :invThumb, invPrice = :invPrice, 
        invStock = :invStock, invSize = :invSize, 
        invWeight = :invWeight, invLocation = :invLocation, 
        categoryId = :catType, invVendor = :invVendor, 
        invStyle = :invStyle WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImg', $invImg, PDO::PARAM_STR);
 $stmt->bindValue(':invThumb', $invThumb, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();
 $stmt->closeCursor();
 return $rowsChanged;
}


function getProductsByCategory($categoryName){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
   }

   function getProductsdetails($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $details;
    

    
   }
?>