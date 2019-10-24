<?php

namespace App\Service;


use Illuminate\Support\Facades\DB;

abstract class ModelRepository
{
    protected $model;

    protected $modelCopy;

    public function __construct($model)
    {
        $this->model = $model;
        $this->modelCopy = $model;
    }

    static public function beginTransaction()
    {
        DB::beginTransaction();
    }

    static public function rollBack()
    {
        DB::rollBack();
    }

    static public function commit()
    {
        DB::commit();
    }

    public function select(){}
}
