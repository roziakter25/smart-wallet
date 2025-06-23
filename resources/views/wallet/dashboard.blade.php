@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">{{ __('Wallet Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ __('Account Information') }}</h5>
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
                            <p><strong>Balance:</strong> ${{ number_format($user->wallet_balance, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ __('Transfer Money') }}</h5>
                            <form method="POST" action="{{ route('wallet.transfer') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">{{ __('Recipient Phone Number') }}</label>
                                    <input type="tel" placeholder="Please enter receipent phone number" class="form-control @error('phone_number') is-invalid @enderror" 
                                           id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">{{ __('Amount') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0.01" 
                                               class="form-control @error('amount') is-invalid @enderror" 
                                               id="amount" name="amount" value="{{ old('amount') }}" required>
                                    </div>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Transfer') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Recent Transactions') }}</span>
                    <a href="{{ route('transactions.index') }}" class="btn btn-primary btn-sm">
                        {{ __('View All') }}
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Date/Time') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Details') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            @if ($transaction->sender_id === auth()->id())
                                                <span class="badge bg-danger">{{ __('Sent') }}</span>
                                            @else
                                                <span class="badge bg-success">{{ __('Received') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>${{ number_format($transaction->amount, 2) }}</strong>
                                        </td>
                                        <td>
                                            @if ($transaction->sender_id === auth()->id())
                                                {{ __('To') }}: {{ $transaction->receiver->name }}
                                                <br>
                                                <small class="text-muted">{{ $transaction->receiver->phone_number }}</small>
                                            @else
                                                {{ __('From') }}: {{ $transaction->sender->name }}
                                                <br>
                                                <small class="text-muted">{{ $transaction->sender->phone_number }}</small>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox mb-2"></i>
                                                <p class="mb-0">{{ __('No transactions found.') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 