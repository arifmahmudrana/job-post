<?php
/**
 * Created by PhpStorm.
 * User: rana
 * Date: 3/28/17
 * Time: 12:06 PM
 */

namespace App\Models;


use ArifMahmudRana\Context\ContextContainer;

abstract class Model implements Validate, Filter, DBSave
{
    protected $table;
    protected $id;
    protected $fields = [];
    protected $data = [];
    protected $original = [];
    protected $messages = [];
    protected $db;

    /**
     * Job constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setOriginal($data);
        $this->setData($this->original);
        $this->filter();
        $this->validate();
        $this->db = ContextContainer::get('db');
    }

    public function setOriginal(array $data = [])
    {
        foreach ($this->fields as $field)
        {
            if (isset($data[$field]))
                $this->original[$field] = $data[$field];
        }

        return $this;
    }

    public function setData(array $data = [])
    {
        $this->data = $data;

        return $this;
    }

    public function isValid()
    {
        return !count($this->messages);
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getOriginal()
    {
        return $this->original;
    }

    public function process()
    {
        return $this;
    }

    public function fire()
    {
        return $this;
    }

    public function insert()
    {

    }

    abstract function save();

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}