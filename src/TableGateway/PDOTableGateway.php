<?php

namespace TableGateway;

class PDOTableGateway
{
    /** @var \PDO */
    private $conn;
    /** @var DataMap */
    private $dataMap;

    /**
     * @param \PDO $conn
     * @param DataMap $dataMap
     */
    public function __construct(\PDO $conn, DataMap $dataMap)
    {
        $this->conn = $conn;
        $this->dataMap = $dataMap;
    }

    /**
     * @param string $where
     * @return array
     */
    public function all($where = '1')
    {
        $columns = implode(', ', $this->dataMap->selectColumns());
        $statement = "SELECT {$columns} FROM {$this->dataMap->tableName()} WHERE {$where}";
        return $this->conn->query($statement)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function byId(string $id): array
    {
        $columns = implode(', ', $this->dataMap->selectColumns());
        $stmt = $this->conn->prepare("SELECT {$columns} FROM {$this->dataMap->tableName()} WHERE id=:id");
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert(array $params)
    {
        $params = array_filter(
            $params,
            function ($key) {
                return in_array($key, $this->dataMap->updateColumns());
            },
            ARRAY_FILTER_USE_KEY
        );

        $columns = implode(', ', $this->dataMap->insertColumns());
        $values = implode(', ', array_map(function ($key) { return ":{$key}"; }, array_keys($params)));

        $stmt = $this->conn->prepare("INSERT INTO {$this->dataMap->tableName()} ({$columns}) VALUES ({$values})");
        $stmt->execute($params);
    }

    public function update(string $id, array $params)
    {
        $params = array_filter(
            $params,
            function ($key) {
                return in_array($key, $this->dataMap->updateColumns());
            },
            ARRAY_FILTER_USE_KEY
        );

        $assignment_list = implode(', ', array_map(function ($key) { return "{$key}=:{$key}"; }, array_keys($params)));

        $stmt = $this->conn->prepare("UPDATE {$this->dataMap->tableName()} SET {$assignment_list} WHERE id=:id");
        $stmt->execute(array_merge($params, ['id' => $id]));
    }
}
