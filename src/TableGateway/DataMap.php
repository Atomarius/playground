<?php

namespace TableGateway;

class DataMap
{
    const tableName = 'tableName';
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

    public function getColumn($name)
    {
        return $this->config['map'][$name] ?? $name;
    }
}
