<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class CartModel extends Database
{
    public function ExistingCart($existingItems)
    {
        if (!empty($existingItems)) {
            $this->itemArray["cartItem"] = $existingItems;
            print_r($this->existingItems);
        }
        print_r($this->existingItems);
    }

    public function CartArray()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` ASC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function CartAdd($code, $quantity)
    {
        echo "tes2t";
        var_dump($code);
        var_dump($quantity);
        if(!empty($_GET["quantity"])) {
            echo "test";
            $this->prepare('SELECT * FROM product WHERE productId = :code');
            $this->statement->bindParam(':code', $code);
            $this->statement->execute();
           // $findCodeInArray = array_search($_GET["code"],  array_column($product_array, 'code'));
            //$findCodeInArray = $this->statement->fetch(PDO::FETCH_ASSOC);
           

           /* $productByCode = $this->statement->fetch(PDO::FETCH_ASSOC);
            var_dump($productByCode);
            $itemArray = array(
                    $productByCode["productId"]=>array(
                        'name'=>$productByCode["title"],
                        'code'=>$productByCode["productId"],
                        'quantity'=>$_GET["quantity"],
                        'price'=>$productByCode["price"]
                    )
            );*/
            $arraylol = $this->statement->fetch(PDO::FETCH_ASSOC);
            $lol[] = $arraylol;
            $findCodeInArray = array_search($_GET["code"],  array_column($lol, 'productId'));
            $productByCode = $lol[$findCodeInArray];
            $itemArray = array(
                    $productByCode["productId"]=>array(
                        'name'=>$productByCode["title"],
                        'code'=>$productByCode["productId"],
                        'quantity'=>$_GET["quantity"],
                        'price'=>$productByCode["price"]
                    )
            );
            //overwrite items with new quantity
            /*if (!empty($_SESSION["cart_item"])){
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            }
            else{
                $_SESSION["cart_item"] = $itemArray;
            }*/

            //add quantity to existing item
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode["productId"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode["productId"] == $k) {
                                    $_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
    }

    public function CartRemove($code){
        //Remove item from cart
            /*if (!empty($this->itemArray["cartItem"])) {
                foreach ($this->itemArray["cartItem"] as $k => $v) {
                    if ($code == $k)
                        unset($this->itemArray["cartItem"][$k]);
                    if (empty($this->itemArray["cartItem"]))
                        unset($this->itemArray["cartItem"]);
                }
            }*/
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $cartItemCode => $v) {
                    var_dump($v);
                    echo "Key: $v<br>";
                    echo "Value: $cartItemCode<br>";
                        if($_GET["code"] == $cartItemCode)
                            unset($_SESSION["cart_item"][$cartItemCode]);
                            var_dump($_SESSION["cart_item"]);
                            var_dump($_SESSION["cart_item"][$cartItemCode]);
                            var_dump($cartItemCode);
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
            }
        }
}