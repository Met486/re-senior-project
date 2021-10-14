@extends('layout')

@section('content')
    <div class="container">
        <label for="ユーザ名">ユーザ名</label>
        <p>{{ $user->name }}</p>
        <label for="良い">良い</label>
        <p>{{ $evaluations[0]  }}</p>
        <label for="普通">普通</label>
        <p>{{ $evaluations[1]  }}</p>
        <label for="悪い">悪い</label>
        <p>{{ $evaluations[2] }}</p>
    </div>
@endsection