@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{ route('assets.store') }}">
            @csrf
            <input type="hidden" name="ledgerType" value="1">
            <div class="form-group">
                <label for="number">Number</label>
                <input type="text" class="form-control" name="number" id="number" required="required">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required="required">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
