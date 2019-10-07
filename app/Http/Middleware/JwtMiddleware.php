<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
        
            $user = JWTAuth::parseToken()->authenticate();
        
        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                $response = [
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token Invalid',
                ];

                return response()->json($response, $response['code']);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                
                $response = [
                    'success' => false,
                    'code' => 400,
                    'message' => 'Token Expire',
                ];
                
                return response()->json($response, $response['code']);
            
            }else{

                $response = [
                    'success' => false,
                    'code' => 400,
                    'message' => 'Authorization Token Not Found',
                ];
                
                return response()->json($response, $response['code']);
            
            }
            
        }

        return $next($request);
    }
}
