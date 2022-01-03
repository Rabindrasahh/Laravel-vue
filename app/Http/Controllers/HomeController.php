<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('home');
  }


  public function getUser()
  {
    $data = User::paginate(10);
    return $data;
  }
  public function editUser($id)
  {
    $data = User::find($id);
    return response()->json($data);
  }


  public function updateUser(Request $request)
  {
    $this->validate($request, [

      'name' => 'required',
      'email' => 'required|email',

    ]);
    $id = $request->id;
    if (!empty($id)) {
      User::where('id', $id)->update(array(
        'name' => $request->name,
        'email' => $request->email,
      ));
    } else {
      return redirect()->route('/');
    }



    return response()->json("User is updated sucessfully");
  }


  public function deleteUser($id)
  {
    $product = User::find($id);
    $product->delete();

    return response()->json('User\'s Information is deleted!');
  }



  public function getUserName()
  {
    $name = Auth::user()->name;
    return response()->json($name);
  }
  public function getUserId()
  {
    $id = Auth::user()->id;
    return response()->json($id);
  }
  public function searchUser(Request $request)
  {

    $data = User::where('name', 'LIKE', '%' . "Rabindra" . '%')->get();
    return response()->json($data);
  }
}
