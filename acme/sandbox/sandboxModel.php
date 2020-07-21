<?php
function getCategories(){
    $db = acmeConnect();
    $sql = 'SELECT categoryName
            FROM categories
            ORDER BY categoryName ASC';

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $stmt->closeCursor();
        return $categories;
        }

        function getStuff(){
            $db = acmeConnect();
            $sql = 'SELECT pracTarget
                    FROM practice
                    ORDER BY pracTarget ASC';
        
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $stuffs = $stmt->fetchAll();
                $stmt->closeCursor();
                return $stuffs;
                }

?>