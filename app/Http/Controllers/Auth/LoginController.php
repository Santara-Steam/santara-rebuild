<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email',
            'password' => 'required',
//            'g-recaptcha-response' => 'required|recaptchav3:login,0.5'
        ]);
        app('request')->session()->put('pwd', $request->password);
        // $secmar = json_decode(app('request')->session()->get('secondary_market'),TRUE);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Success
            //$this->getTokenUser($request->email, $request->password);
            if (Auth::user()->role_id == 2) {
                return redirect('user');
            } else if (Auth::user()->role_id == 1) {
                return redirect('admin');
            } else {

                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }

    }

    public function getTokenUser($email, $password)
    {
        try {
            $client = new Client();

            $response = $client->request('POST', config('global.BASE_API_CLIENT_URL').'/v3.7.1/auth/login/', [
              'headers' => [
                'Origin' => config('global.BASE_API_FILE')
              ],
              'form_params' => [
                'email' => $email,
                'password' => $password
              ],
            ]);

            // app('request')->session()->put('test', $response->getStatusCode());
            if ($response->getStatusCode() == 200) {
                $result = json_decode($response->getBody()->getContents(), TRUE);
                app('request')->session()->put('token', $result['token']['token']);
                app('request')->session()->put('refreshToken', $result['token']['refreshToken']);

                $photo_url = config('global.BASE_API_FILE') . Auth::user()->trader->photo;
                  // market session
                  $market_url = json_encode([
                    'token' => $result['token']['token'],
                    'expired_in' => date('Y-m-d'),
                    'username' => $result['user']['trader']['name'],
                    'refresh_token' => $result['token']['refreshToken'],
                    'photos' => isset($photo_url) ? $photo_url : 'https://storage.googleapis.com/asset-santara-staging/santara.co.id/images/error/no-image-user.png'
                  ]);
                  app('request')->session()->secondary_market = ['urlMarket' => $market_url];
                  // app('request')->session()->put('secondary_market', ['urlMarket' => $market_url]);

            }
        } catch (\Exception $exception) {
            app('request')->session()->put('token', 'fail');

        }
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth::user()->role_id == 2) {
            return '/user';
        } else if (Auth::user()->role_id == 1) {
            return '/admin';
        } else {
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
