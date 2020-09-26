@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
{{--            <div class="col-md-12 text-md-right">--}}
{{--                <a href="{{ route('assets.create') }}"><i class="fad fa-plus-square"></i></a>--}}
{{--            </div>--}}
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">To account</th>
                        <th scope="col">To holder</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->contraAccount }}</td>
                            <td>{{ $transaction->contraAccountHolder }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>
                                @if ($transaction->amount < 0)
                                  <b style="color: red;">{{ number_format($transaction->amount / 100, 2) }}</b>
                                @else
                                    <b>{{ number_format($transaction->amount / 100, 2) }}</b>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
