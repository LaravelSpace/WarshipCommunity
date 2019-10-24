<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;

interface ResourceApiInterface
{
    public function index(Request $request);

    public function store(Request $request);

    public function show(Request $request, $id);

    public function edit(Request $request);

    public function update(Request $request);

    public function destroy(Request $request);
}