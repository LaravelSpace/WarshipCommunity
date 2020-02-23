<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;

interface ApiResourceInterface
{
    public function listModel(Request $request);

    public function createModel(Request $request);

    public function showModel(Request $request, $id);

    public function editModel(Request $request, $id);

    public function updateModel(Request $request, $id);

    public function deleteModel(Request $request, $id);
}
