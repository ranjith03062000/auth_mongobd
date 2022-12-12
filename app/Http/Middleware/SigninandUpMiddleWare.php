<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class SigninandUpMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data           = $request->all();
        $decrypted      = json_decode(openssl_decrypt(base64_decode($request->input),"AES-256-CBC","decryption Password",0,'1234567891011121'));
        $request['inputData']=$decrypted;
        unset($request['input']);
        return $next($request);

    }
}
