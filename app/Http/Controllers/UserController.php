<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Redirect;
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    //
    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function register()
    {
        if ($user = \Sentinel::registerAndActivate(Input::all())) {
            return Redirect::to('/')->with("Successfully Registered");
        }
        return Redirect::back()->withErrors("Oh, There Was An Error!");
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $user = Input::all();
        if (\Sentinel::check()) {
            return Response::json([
                'message' => 'You Already Logged In To System!',
                'code' => '403',
            ], 403);
        } elseif (!\Sentinel::authenticate($user)) {
            return Response::json([
                'message' => 'Please Enter Valid Email or Password',
                'code' => 403,
            ], 403);
        } else {
            \Sentinel::authenticate($user);
            return Response::json([
                'message' => 'You Succeffully Logged In!',
                'code' => 200,
            ], 200);
        }
    }

    /**
     * @param id
     * @return Redirect
     */
    public function update(Request $request,$id)
    {
        if(\Sentinel::check()){
            $user = \Sentinel::findById($id);
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ];
           \Sentinel::update($user, $data);
            return Redirect::back(301);
        }else{
            return Response::json([
                'message' => 'Unauthorized Member !',
                'code' => 401
            ], 401);
        }
    }

    /**
     * @param id
     * @return JsonResponse
     */
    public function delete($id)
    {
        if(\Sentinel::check()){
            $user = \Sentinel::findById($id);
            $user->delete();
            return Response::json([
                    'message' => 'User Delete Successfully',
                    'code' => 200
                ],200);
        }
    }

    /**
     * @param id
     * @return JsonResponse
     */
    public function edit($id)
    {
        if ($user = \Sentinel::getUser() && \Sentinel::check()) {
            $user = \Sentinel::findById($id);
        return view('edit',compact('user'));
        } else {
            return Response::json([
                'message' => 'Unauthorized Member !',
                'code' => 401
            ], 401);
        }
    }


    /**
     * @param id
     * @return JsonResponse
     */
    public function profile($id)
    {

        if (\Sentinel::check()) {
            return Response::json([
                'data' => \Sentinel::findById($id),
                'code' => 200
            ], 200);
        } elseif (!\Sentinel::check()) {
            return Response::json([
                'message' => "You Don't Have Premession To Access This Page",
                'code' => 403
            ], 403);
        } elseif (\Sentinel::findById($id) == NULL) {
            return Response::json([
                'message' => "User Not Found!",
                'code' => 404
            ], 404);
        }

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (\Sentinel::guest()) {
            return Response::json([
                'message' => 'You Are Not Logged In Currentlly!',
                'code' => 403
            ], 403);
        }
        \Sentinel::logout();
        return Response::json([
            'message' => 'You Logged Out Successfully',
            'code' => 200,
        ], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function role(Request $request)
    {
        if (\Sentinel::check() && $user = \Sentinel::getUser()) {
            $role = \Sentinel::getRoleRepository()->createModel()->create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            return Response::json([
                'message' => 'Role Created Successfully',
                'data' => $role,
                'code' => 201
            ], 201);
        }else{
            return Response::json([
                'message' => 'Unauthorized Member !',
                'code' => 401
            ], 401);
        }
    }
}
