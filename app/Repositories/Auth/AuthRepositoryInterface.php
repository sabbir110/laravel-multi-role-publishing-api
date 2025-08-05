<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function register(Request $request);
    public function login(Request $request);
    public function me(Request $request);
    public function logout(Request $request);
    public function refresh(Request $request);
}
