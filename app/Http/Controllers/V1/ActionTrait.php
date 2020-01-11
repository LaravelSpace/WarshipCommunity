<?php

namespace App\Http\Controllers\V1;


use App\Exceptions\ServiceException;

trait ActionTrait
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
        } catch (ServiceException $e) {
            return $this->response([], config('constant.error'), 400, $e->getMessage());
        } catch (\Exception $e) {
            $trace = $e->getTrace();

            return $this->response(['trace' => $trace[0]], config('constant.error'), 500, $e->getMessage());
        }
    }
}
