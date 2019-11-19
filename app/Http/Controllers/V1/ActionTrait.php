<?php

namespace App\Http\Controllers\V1;


class ActionTrait
{
    use ResponseTrait;

    public function callAction($method, $parameters)
    {
        try {
            if (method_exists($this, 'beforeAction')) {
                call_user_func_array([$this, 'beforeAction'], $parameters);
            }
            $return = call_user_func_array([$this, $method], $parameters);
            if (method_exists($this, 'afterAction')) {
                call_user_func_array([$this, 'afterAction'], $parameters);
            }

            return $return;
        } catch (\Exception $e) {
            $trace = $e->getTrace();

            return $this->response(['trace' => $trace[0]], 500, $e->getMessage());
        }
    }
}
