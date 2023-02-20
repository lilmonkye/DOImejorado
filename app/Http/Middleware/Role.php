<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;


class Role {

  public function handle($request, Closure $next, String $role) {
    if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
    return redirect('login');

  $user = Auth::user();
  if($user->role == $role)
  {
      return $next($request);
  }

  // Si el usuario no tiene el rol correspondiente, redirigimos al dashboard correspondiente

  return redirect('/' . $user->role . '_dashboard');
  }
}
