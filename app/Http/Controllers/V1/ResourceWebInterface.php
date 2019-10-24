<?php

namespace App\Http\Controllers\V1;


use Illuminate\Http\Request;

interface ResourceWebInterface
{
    public function index(Request $request);

    public function create(Request $request);

    public function show(Request $request);

    public function edit(Request $request);
}