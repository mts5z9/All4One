@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @include('inc.showcase')
                <div class="panel-heading ">Business Benefits of all4one rewards</div>

                <div class="panel-body">
                  <li>Centralized Rewards System</li>
                  <li>NFC Technology</li>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  <a type="button" class="btn btn-info" name="register" href="/businessRegister">Create an account for your business</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
