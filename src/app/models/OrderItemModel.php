<?php

class OrderItemModel
{
    use Model; 

    protected $table = 'order_items';

    protected $allowedColumns = [
        'order_id',
        'album_id',
        'quantity',
        'price'
    ];
}

