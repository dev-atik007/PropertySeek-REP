<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // if ($request->user()->role !== $role) {
        //     return redirect()->route('dashboard');
        // }

        $userRole = $request->user()->role;

        if ($userRole === 'user' && $role !== 'user') {
            return redirect()->route('user.dashboard');
        } elseif ($userRole === 'admin' && $role === 'user') {
            return redirect()->route('admin.dashboard');
        } elseif ($userRole === 'agent' && $role === 'user') {
            return redirect()->route('agent.dashboard');
        } elseif ($userRole === 'admin' && $role === 'agent') {
            return redirect()->route('admin.dashboard');
        } elseif ($userRole === 'agent' && $role === 'admin') {
            return redirect()->route('agent.dashboard');
        }
        
        return $next($request);
    }
}
