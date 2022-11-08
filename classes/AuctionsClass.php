<?php

class Auctions{

   protected int $auctionprice;
   protected string $auctiondate;
//    id car ?
// id user?

protected function __construct(int $auctionprice, string $auctiondate)
{
    $this->auctionprice=$auctionprice;
    $this->auctiondate=$auctiondate;
}

}

?>