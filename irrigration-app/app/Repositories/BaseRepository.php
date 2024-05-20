<?php

namespace App\Repositories;


abstract class BaseRepository
{
    const PAGINATION = 15;

    public abstract function getModel();


    public function findById($id)
    {
        return $this->getModel()->where('id', $id)->first();
    }

    public function findByName($name)
    {
        return $this->getModel()->where('name', $name)->first();
    }

    public function findAll($conditions = [], $with = [], $column = 'id', $order = 'DESC')
    {
        return $this->getModel()->where($conditions)->with($with)->orderBy($column, $order)->get();
    }

    public function findAllPaginate($conditions = [], $with = [])
    {
        return $this->getModel()->where($conditions)->with($with)->orderBy('id', 'DESC')->paginate(self::PAGINATION);
    }

    public function findAllAndSelect($columns = '*', $conditions = [])
    {
        return $this->getModel()->where($conditions)->selectRaw($columns)->orderBy('id', 'DESC')->get();
    }

    public function insert($attributes)
    {
        return $this->getModel()->create($attributes);
    }

    public function update($attributes, $id)
    {
        return $this->findById($id)->update($attributes);
    }

    public function deleteById($id): bool
    {
        $result = $this->findById($id);
        if ($result) {
            return $this->getModel()->destroy($id);
        }
        return false;
    }
}