<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Repository\OrderRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware(['auth', 'role']);
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return datatables()->of(User::latest())
                ->addColumn('action', 'admin.users.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {
        $user = User::with('roles')->findOrFail($key);

        if (request()->expectsJson()) {
            return datatables()->of($user->roles)
                ->addColumn('action', 'admin.roles.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.users.show', compact('user'));
    }
}
