<?php

namespace TableGateway;

use Doctrine\DBAL\Connection;

class DoctrineTableGateway
{
    /** @var Connection */
    private $connection;
    /** @var DataMap */
    private $dataMap;

    /**
     * @param Connection $connection
     * @param DataMap $dataMap
     */
    public function __construct(Connection $connection, DataMap $dataMap)
    {
        $this->connection = $connection;
        $this->dataMap = $dataMap;
    }

    /**
     * @param string $where
     * @return array
     */
    public function all($where = '1')
    {
        $sql = $this->connection->createQueryBuilder();
        $sql->select($this->dataMap->selectColumns())
            ->from($this->dataMap->tableName())
            ->where($where);

        return $sql->execute()->fetchAll();
    }

    public function byId(string $id): array
    {
        $sql = $this->connection->createQueryBuilder();
        $pk = $this->dataMap->primaryKey();
        $sql->select($this->dataMap->selectColumns())
            ->from($this->dataMap->tableName())
            ->where("{$pk}=:{$pk}")
            ->setParameters([$pk => $id]);

        return $sql->execute()->fetch();
    }

    public function insert(array $params)
    {
        $params = $this->filter($params, $this->dataMap->insertColumns());
        $values = array_reduce(array_keys($params), function (array $carry, $key) { $carry[$key] = ":{$key}"; }, []);
        $sql = $this->connection->createQueryBuilder();
        $sql->insert($this->dataMap->tableName())->values($values);
        $sql->setParameters($params);
        $sql->execute();
    }

    public function update(string $id, array $params)
    {
        $params = $this->filter($params, $this->dataMap->updateColumns());
        $pk = $this->dataMap->primaryKey();
        $sql = $this->connection->createQueryBuilder();
        $sql->update($this->dataMap->tableName());
        foreach ($params as $key => $value) {
            $sql->set($key, ":{$key}");
        }
        $sql->where("{$pk}=:{$pk}");
        $sql->setParameters(array_merge($params, [$pk => $id]));
        $sql->execute();
    }

    public function delete(string $id)
    {
        $pk = $this->dataMap->primaryKey();
        $sql = $this->connection->createQueryBuilder();
        $sql->delete($this->dataMap->tableName())->where("{$pk}=:{$pk}")->setParameters([$pk => $id]);
        $sql->execute();
    }

    private function filter($params, $columns)
    {
        return array_filter(
            $params,
            function ($key) use ($columns) {
                return in_array($key, $columns);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
