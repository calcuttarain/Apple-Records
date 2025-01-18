<?php

class Model 
{
    use Database;

    protected $table = "users";
    protected $limit = 10;
    protected $offset = 0;

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
        $query .= " limit $this->limit offset $this->offset";

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

    public function update($id, $data)
    {
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

        return $this->query($query, $data);

        return false;
    }
}
