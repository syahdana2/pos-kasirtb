<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cek_cart = session()->get('cart');
        if($cek_cart){
            return $next($request);
        } 
        return redirect()->route('transaction')->with('error', 'Anda belum memilih produk untuk lanjut ke proses transaksi');
    }
}
