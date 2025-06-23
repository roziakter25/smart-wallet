@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Transaction History') }}</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Date/Time') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('From') }}</th>
                                    <th>{{ __('To') }}</th>
                                    <th>{{ __('Status') }}</th>
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
                                            {{ $transaction->sender->name }}
                                            <br>
                                            <small class="text-muted">{{ $transaction->sender->phone_number }}</small>
                                        </td>
                                        <td>
                                            {{ $transaction->receiver->name }}
                                            <br>
                                            <small class="text-muted">{{ $transaction->receiver->phone_number }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ __('Completed') }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>{{ __('No transactions found.') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Transaction Summary') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted">{{ __('Total Sent') }}</h6>
                                <h4 class="text-danger mb-0">${{ number_format(auth()->user()->sentTransactions()->sum('amount'), 2) }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted">{{ __('Total Received') }}</h6>
                                <h4 class="text-success mb-0">${{ number_format(auth()->user()->receivedTransactions()->sum('amount'), 2) }}</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 text-center">
                                <h6 class="text-muted">{{ __('Current Balance') }}</h6>
                                <h4 class="text-primary mb-0">${{ number_format(auth()->user()->wallet_balance, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.75em;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endpush 