<?php
defined('BASE_PATH') or exit('No direct script access allowed');

require_once __DIR__.'/../core/database.php';
require_once __DIR__.'/../models/sql/invoicesql.php';

class InvoiceModel extends Database
{
    public function InvoiceArray()
    {
        $this->prepare(INVOICES);
        $this->statement->execute();
        return $this->statement->fetchAll();
    }

    public function InvoiceFromCurrentUID()
    {
       /* $this->prepare(INVOICEFROMUID);
        $this->statement->execute([Session::Get('uid')]);
        
        return $this->statement->fetchAll();*/
        $this->prepare(INVOICEFROMUID);
        $this->statement->execute([Session::Get('uid')]);
		while($row=$this->statement->fetch(PDO::FETCH_ASSOC)) {
			$results[] = $row;
		}		
		if(!empty($results))
        {

            foreach($results as $i => $item) {
                //var_dump($results[$i]);
                $itemArray = array($results[$i]["orderId"]=>array(
                    'totalprice'=>$results[$i]["totalprice"],
                    'orderId'=>$results[$i]["orderId"],
                    'status'=>$results[$i]["status"],
                    'price'=>$results[$i]["price"],
                    'orderDate'=>$results[$i]["orderDate"]));
                    $itemArray = array_merge($itemArray,$results);
                    if(!empty($results)) {
                        if(in_array($results[$i]["orderId"],array_keys($results))) {
                            foreach($itemArray as $k => $v) {
                               // var_dump($k);
                                    if($results[$i]["orderId"] == $k) {
                                        //var_dump($itemArray);
                                        foreach($results as $lol => $item) {
                                        $itemArray[$k]["price"] += $results[$lol]["price"];
                                        //var_dump($itemArray);
                                        }
                                        $itemArray = array_merge($itemArray,$results);
                                    }
                            }
                        }
                    }
                //echo $array[$i]['filepath'];
            
                // $array[$i] is same as $item
            
    
		    
                }
                var_dump($itemArray);
                return $itemArray;
        }
    }

    public function DeleteInvoice($invoiceID, $userID)
    {
        $this->prepare(DELETEINVOICE);
        $this->statement->execute([$invoiceID, $userID]);
    }

    public function InvoiceStatus($invoiceID, $userID)
    {
        $this->prepare(INVOICESTATUS);
        $this->statement->execute([$invoiceID, $userID]);
        $result = $this->statement->fetch();
        $result->status = ((int) $result->status === 0) ? 'Not shipped' : 'Shipped';
        return $result;
    }
}