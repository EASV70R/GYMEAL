<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';

class CartModel extends Database
{
    public $itemArray;
    public $newItemArray;
    public function ExistingCart($existingItems)
    {
        if (!empty($existingItems)) {
            $this->itemArray["cartItem"] = $existingItems;
        }
    }

    public function CartArray()
    {
        $this->prepare('SELECT * FROM `product` ORDER BY `productId` ASC');
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function CartAdd($code, $quantity)
    {
        $db_handle = new DBController();
        if (!empty($quantity)) {
            $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE productId='" . $code . "'");
            $this->newItemArray = array($productByCode[0]["productId"] => array(
                'title' => $productByCode[0]["title"],
                'productId' => $productByCode[0]["productId"],
                'quantity' => $_POST["quantity"],
                'price' => $productByCode[0]["price"]));

            if (!empty($this->itemArray["cartItem"])) {
                if (in_array($productByCode[0]["productId"], array_keys($this->itemArray["cartItem"]))) {
                    foreach ($this->itemArray["cartItem"] as $k => $v) {
                        if ($productByCode[0]["productId"] == $k) {
                            $this->itemArray["cartItem"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    $this->itemArray["cartItem"] = array_merge($this->itemArray["cartItem"], $this->newItemArray);
                }
            } else {
                $this->itemArray["cartItem"] = $this->newItemArray;
            }
        }
    }

    public function cartRemove($code){
        //Remove item from cart
            if (!empty($this->itemArray["cartItem"])) {
                foreach ($this->itemArray["cartItem"] as $k => $v) {
                    if ($code == $k)
                        unset($this->itemArray["cartItem"][$k]);
                    if (empty($this->itemArray["cartItem"]))
                        unset($this->itemArray["cartItem"]);
                }
            }
        }
}