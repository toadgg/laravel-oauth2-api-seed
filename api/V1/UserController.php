<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhangxiaoliang
 * Date: 15/7/2
 * Time: 下午3:42
 */

namespace Api\V1;

use App\User;
use Validator;
use Request;
use Auth;
use App;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Api\Controller;

class UserController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    protected function register()
    {
        $rules = [
            'username' => ['required', 'alpha'],
            'password' => ['required', 'min:7']
        ];

        $payload = Request::only('username', 'password');
        $validator = Validator::make($payload, $rules);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('创建用户失败.', $validator->errors());
        }

        return User::create([
            'name' => $payload['username'],
            'password' => bcrypt($payload['password']),
        ]);
    }

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

}