<?php

namespace TableGateway;

class DataMap
{
    const tableName = 'tableName';
    const primaryKey = 'primaryKey';
    const insertColumns = 'insertColumns';
    const selectColumns = 'selectColumns';
    const updateColumns = 'updateColumns';

    private $config;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function tableName()
    {
        return $this->config[self::tableName] ?? '';
    }

    public function primaryKey()
    {
        return $this->config[self::primaryKey] ?? '';
    }

    public function insertColumns()
    {
        return $this->config[self::insertColumns] ?? [];
    }

    public function selectColumns()
    {
        return $this->config[self::selectColumns] ?? [];
    }

    public function updateColumns()
    {
        return $this->config[self::updateColumns] ?? [];
    }
}
