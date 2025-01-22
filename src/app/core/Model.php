<?php

trait Model 
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type 	= "desc";
	protected $order_column = "id";

    private function query($query, $data = [])
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }

        return false;
    }

    public function insert($data)
    {
        if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

        $keys = array_keys($data);
        $query = "insert into $this->table (".implode(", ", $keys).") values (:".implode(", :", $keys).")";

        $this->query($query, $data);

        return false;
    }

    public function select($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function select_first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);

        return $this->query($query, $data)[0];
    }

    public function findAll()
	{
	 
		$query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
	
		return $this->query($query);
	}

    public function update($id, $data)
    {
        if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

        $keys = array_keys($data);
        $setPart = [];

        foreach ($keys as $key) {
            $setPart[] = "$key = :$key";
        }

        $query = "update $this->table set " . implode(", ", $setPart) . " where id = :id";

        $data['id'] = $id;

        return $this->query($query, $data);
    }

    public function delete($id)
    {
        $query = "delete from $this->table where id = :id";

        $data = ['id' => $id];

        $this->query($query, $data);

        return false;
    }

    protected function customQuery($sql, $data = [])
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $check = $stmt->execute($data);
        if ($check) {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
        return [];
    }

}
