<?php
// src/Mynorel/Plotline/Database/QueryBuilder.php

namespace Mynorel\Plotline\Database;

use PDO;

class QueryBuilder
{
    protected $table;
    protected $select = '*';
    protected $where = [];
    protected $bindings = [];
    protected $limit;
    protected $order;

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function select($fields)
    {
        $this->select = is_array($fields) ? implode(',', $fields) : $fields;
        return $this;
    }

    public function where($field, $op, $value)
    {
        $this->where[] = "$field $op ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function orderBy($field, $direction = 'asc')
    {
        $this->order = "$field $direction";
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = (int)$limit;
        return $this;
    }

    public function get()
    {
        $sql = "SELECT {$this->select} FROM {$this->table}";
        if ($this->where) {
            $sql .= " WHERE " . implode(' AND ', $this->where);
        }
        if ($this->order) {
            $sql .= " ORDER BY {$this->order}";
        }
        if ($this->limit) {
            $sql .= " LIMIT {$this->limit}";
        }
        $stmt = Connection::pdo()->prepare($sql);
        $stmt->execute($this->bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }
}
