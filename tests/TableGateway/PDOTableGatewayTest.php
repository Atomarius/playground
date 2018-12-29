<?php

namespace TableGateway;

use Mockery as M;

class PDOTableGatewayTest extends \PHPUnit\Framework\TestCase
{

    public function testAll()
    {

    }

    public function testById()
    {
        /** @var \PDO|M\Mock $pdo */
        $pdo = M::mock(\PDO::class);
        $dataMap = new DataMap([
            DataMap::tableName => 'table_name',
            DataMap::primaryKey => 'primary_key',
            DataMap::selectColumns => ['*'],
            DataMap::insertColumns => ['insert'],
            DataMap::updateColumns => ['update']
        ]);

        $stmt = M::mock(\PDOStatement::class);
        $stmt->shouldReceive('execute');
        $stmt->shouldReceive('fetch')->andReturn([]);

        $pdo->shouldReceive('prepare')
            ->with('SELECT * FROM table_name WHERE primary_key=:primary_key')
            ->andReturn($stmt);

        $tableGateway = new PDOTableGateway($pdo, $dataMap);
        $tableGateway->byId('anId');
    }

    public function testUpdate()
    {
        /** @var \PDO|M\Mock $pdo */
        $pdo = M::mock(\PDO::class);
        $dataMap = new DataMap([
            DataMap::tableName => 'table_name',
            DataMap::primaryKey => 'primary_key',
            DataMap::selectColumns => ['*'],
            DataMap::insertColumns => ['insert'],
            DataMap::updateColumns => ['update']
        ]);

        $stmt = M::mock(\PDOStatement::class);
        $stmt->shouldReceive('execute');
        $pdo->shouldReceive('prepare')
            ->with('UPDATE table_name SET update=:update WHERE primary_key=:primary_key')
        ->andReturn($stmt);

        $tableGateway = new PDOTableGateway($pdo, $dataMap);
        $tableGateway->update('anId', ['update' => 'aValue']);
    }

    public function testInsert()
    {
        /** @var \PDO|M\Mock $pdo */
        $pdo = M::mock(\PDO::class);
        $dataMap = new DataMap([
            DataMap::tableName => 'table_name',
            DataMap::primaryKey => 'primary_key',
            DataMap::selectColumns => ['*'],
            DataMap::insertColumns => ['insert'],
            DataMap::updateColumns => ['update']
        ]);

        $stmt = M::mock(\PDOStatement::class);
        $stmt->shouldReceive('execute');
        $pdo->shouldReceive('prepare')
            ->with('INSERT INTO table_name (insert) VALUES (:insert)')
            ->andReturn($stmt);

        $tableGateway = new PDOTableGateway($pdo, $dataMap);
        $tableGateway->insert(['insert' => 'aValue']);
    }
}
