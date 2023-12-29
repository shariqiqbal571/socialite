<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class ConnectController extends Controller
{
    public function googleLogin() {
        return Socialite::driver('google')->redirect();        
    }
    public function googleHandle(){
        try{
            $user=Socialite::driver('google')->user();
             dd($user);
            // $findUser=User::where('email',$user->email)->first();
            
        //     if(!$findUser){
              
        //        $findUser=new User();
        //         $findUser->name=$user->name;
        //      $findUser->email=$user->email;
        //     $findUser->password="12345678";
        //         $findUser->save();
        //     }
        //     session()->put('id',$findUser->id);
        //    session()->put('id',$findUser->Type);
        //     return redirect('/');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }



    public function microsoftLogin()
    {
        $state = Session::getId();

        $params = [
            'client_id' => 'aca2e56a-258c-4038-bf76-a10338bdd831',
            'redirect_uri' => 'http://localhost:8000/auth/microsoft/callback/',
            'response_type' => 'token',
            'scope' => 'https://graph.microsoft.com/User.Read',
            'state' => $state,
        ];

     
 
        $loginUrl = 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize';

       

          $redirectUrl = $loginUrl . '?' . http_build_query($params);




        return response()->json(['redirect_url' => $redirectUrl]);
        
    }

    public function microsoftHandle(Request $request)
    {
    

        if ($request->access_token) {
        
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $request->access_token,
                'Content-type' => 'application/json',
            ])->get('https://graph.microsoft.com/v1.0/me/');

            $userData = $response->json();

            if (isset($userData['error'])) {
                dd($userData['error']);
            }

            Session::put('msatg', 1); // Authenticated and verified
            Session::put('uname', $userData['displayName']);
            Session::put('id', $userData['id']);

            return redirect('/');
        }

        return view('welcome');
    }
    public function microsoftHandleajax(Request $request)
    {
   

        if ($request->access_token) {
           



            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $request->access_token,
                'Content-type' => 'application/json',
            ])->get('https://graph.microsoft.com/v1.0/me/');

            $userData = $response->json();

            if (isset($userData['error'])) {
                dd($userData['error']);
            }

            Session::put('msatg', 1); // Authenticated and verified
            Session::put('uname', $userData['displayName']);
            Session::put('id', $userData['id']);
            return response()->json(['userData' => $userData]);
           
        }

        return view('welcome');
    }


  
    
}



