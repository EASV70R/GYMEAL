<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class CartModel extends Database
{
    public function runQuery($code) {
        $this->prepare('SELECT * FROM product WHERE productId = :code');
        $this->statement->bindParam(':code', $code);
        $this->statement->execute();
		//$result = $this->statement->fetch(PDO::FETCH_ASSOC);
		while($row=$this->statement->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}		
		if(!empty($results))
			return $results;
	}

    public function CartAdd($code, $quantity)
    {
        if(!empty($quantity)) {
            $productByCode = $this->runQuery($code);
			$itemArray = array($productByCode[0]["code"]=>array(
			    'name'=>$productByCode[0]["title"],
                'code'=>$productByCode[0]["code"],
                'quantity'=>$quantity,
                'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								$_SESSION["cart_item"][$k]["quantity"] += $quantity;
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

    public function CartRemove($code)
    {
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($v['code'] == $code)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }
    }

    public function CartEmpty()
    {
        unset($_SESSION["cart_item"]);
    }
}