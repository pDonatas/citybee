<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoValidationRequest;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function openWallet(Request $request)
    {
        $user = Auth::user();
        $id = NULL;
        if (isset($user)) {
            $id = $user->id;
        }

        $userExists = NULL;

        if (isset($id)) {
            $userExists = User::find($id);
        }


        if (isset($userExists)) {
            $wallet = Wallet::where('userId', $id)->first();

            if (!$wallet) {
                $wallet = Wallet::create(["amount" => 0, "userId" => $id]);
            }

            return view('wallet.index', [
                'wallet' => $wallet
            ]);
        } else {
            return view('wallet.index', [
                'error' => "Wallet owner is not known. Login to your account"
            ]);
        }
    }

    public function addMoney()
    {
        $user = Auth::user();
        if (isset($user)) {
            return view('wallet.add_money', [
                'userId' => $user->id
            ]);
        } else {
            return redirect("/wallet");
        }
    }

    public function updateBalance(Request $request)
    {
        $wallet = Wallet::where("userId", $request->userId)->first();
        $currentAmount = $wallet->amount;
        $wallet->amount =  $currentAmount + $request->amount;
        $wallet->save();
        return redirect("/wallet/".Auth::user()->id);
    }
}
