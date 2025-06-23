<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $transactions = $user->transactions()->latest()->take(3)->get();

        return view('wallet.dashboard', compact('user', 'transactions'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'phone_number' => [
                'required',
                'string',
                'exists:users,phone_number',
                function ($attribute, $value, $fail) {
                    if ($value === Auth::user()->phone_number) {
                        $fail('You cannot transfer money to your own account.');
                    }
                },
            ],
            'amount' => 'required|numeric|min:0.01'
        ]);

        $sender = Auth::user();
        $receiver = User::where('phone_number', $request->phone_number)->first();

        if ($sender->wallet_balance < $request->amount) {
            return back()->with('error', 'Insufficient balance for this transfer.');
        }

        try {
            DB::transaction(function () use ($sender, $receiver, $request) {
                // Update balances
                $sender->decrement('wallet_balance', $request->amount);
                $receiver->increment('wallet_balance', $request->amount);

                // Create transaction record
                Transaction::create([
                    'sender_id' => $sender->id,
                    'receiver_id' => $receiver->id,
                    'amount' => $request->amount
                ]);
            });

            return back()->with('success', 'Transfer completed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Transfer failed. Please try again.');
        }
    }
}
