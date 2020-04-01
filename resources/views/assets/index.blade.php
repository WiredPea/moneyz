@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-md-right">
                <a href="{{ route('assets.create') }}"><i class="fad fa-plus-square"></i></a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($assets as $asset)
                    <tr>
                        <th scope="row">{{ $asset->number }}</th>
                        <td>{{ $asset->name }}</td>
                        <td>Icons</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
