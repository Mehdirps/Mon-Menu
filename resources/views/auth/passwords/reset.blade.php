@extends('layouts.app')

@section('content')


 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');

        .welcome_wrap{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction:column;
            height: calc(100vh - 30px);
        }
        h1,h2{
            color: #452f27;
        }

        body{
            background-image: url({{ asset("img/leather2.jpg" )}});
            border: 15px solid #452f27;
            font-family: 'Raleway';
            text-align: center;
        }

        .copy{
            position: fixed;
            bottom: 30px;
            right: 30px;
            font-size: 12px;
            color: #452f27;
        }

        .btn-danger{
            background-color: #452f27;
            border-color: #452f27;
        }


        span.logo{
            width: 150px;
            height: 150px;
            display: block;
        }

        @media(max-width:780px){
            h2{
                font-size: 22px;
                width: 80%;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 25px;
            }
        }

    </style>


  <div class="welcome_wrap">



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
