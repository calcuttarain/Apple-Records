<?php

class OrderModel
{
    use Model; 

    protected $table = 'orders';

    protected $allowedColumns = [
        'user_id',
        'order_date',
        'status',
        'total_amount'
    ];

    public function createOrder($userId, $status, $totalAmount)
    {
        $data = [
            'user_id'      => $userId,
            'status'       => $status,
            'total_amount' => $totalAmount,
        ];

        $sql = "
            INSERT INTO {$this->table} (user_id, status, total_amount)
            VALUES (:user_id, :status, :total_amount)
        ";
        $this->query($sql, $data);

        $result = $this->query("SELECT LAST_INSERT_ID() AS last_id");
        if ($result && is_array($result) && isset($result[0]->last_id)) {
            return $result[0]->last_id; 
        }

        return 0;
    }

    public function getUserOrders($userId)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE user_id = :uid
            ORDER BY order_date DESC
        ";

        return $this->query($sql, ['uid' => $userId]) ?: [];
    }
}

