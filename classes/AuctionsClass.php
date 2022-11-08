<?php

class Auctions{

   protected float $auctionprice;
   protected string $auctiondate;
//    id car ?
// id user?

protected function __construct(float $auctionprice, string $auctiondate)
{
    $this->auctionprice=$auctionprice;
    $this->auctiondate=$auctiondate;
}

}

?>