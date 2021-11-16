<?php

namespace App\Http\Middleware;
use Closure;
use App\User;

class CheckApiToken
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
        //Recupero l'authorization token dalla request
        $auth_token = $request->header('authorization');

        // Verifico se è presente un token di autorizzazione
        if(empty($auth_token)){
            return response()->json([
                'success'=>false,
                'error'=>'API Token mancante'
            ]);
        }

        //Estrarre l'API Token di autorizzazione che è composto in questo modo: 'Bearer vkIr9pgfM4L2k4aBUrsp7MHxBXL9e6xuEHhvQeoeZt1tZx8gxY8uzDm2nUuza1nyHpKmj5XWn4JmC5X9'
        $api_token = substr($auth_token, 7);

        // Verifico la correttezza dell'api token
        $user = User::where('api_token', $api_token)->first();
        // e predispondo una risposta di errore in caso di token mancante o sbagliato
        if(!$user){
            return response()->json([
                'success'=>false,
                'error'=>'API Token errato'
            ]);
        }
        // se $user è presente allora dal middleware passo all'elaborazione della chiamata API che mi restituirà i dati richiesti
        return $next($request);
    }
}
