<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;

interface ResourceApiInterface
{
    public function store(Request $request);

    public function index(Request $request);

    public function show(Request $request, $id);

    public function edit(Request $request, $id);

    public function update(Request $request,$id);

    public function destroy(Request $request,$id);
}