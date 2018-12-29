<?php

namespace TableGateway;


class DataMapTest extends \PHPUnit\Framework\TestCase
{
    private $config = [
        DataMap::tableName => 'table_name',
        DataMap::primaryKey => 'primary_key',
        DataMap::selectColumns => ['*'],
        DataMap::insertColumns => ['insert'],
        DataMap::updateColumns => ['update']
    ];

    public function testSelectColumns()
    {
        $dataMap = new DataMap($this->config);

        $this->assertEquals($this->config[DataMap::selectColumns], $dataMap->selectColumns());
    }

    public function testPrimaryKey()
    {
        $dataMap = new DataMap($this->config);

        $this->assertEquals($this->config[DataMap::primaryKey], $dataMap->primaryKey());

    }


    public function testInsertColumns()
    {
        $dataMap = new DataMap($this->config);

        $this->assertEquals($this->config[DataMap::insertColumns], $dataMap->insertColumns());
    }

    public function testTableName()
    {
        $dataMap = new DataMap($this->config);

        $this->assertEquals($this->config[DataMap::tableName], $dataMap->tableName());
    }

    public function testUpdateColumns()
    {
        $dataMap = new DataMap($this->config);

        $this->assertEquals($this->config[DataMap::updateColumns], $dataMap->updateColumns());
    }
}
