@extends('layout.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        *, *:before, *:after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
            background: #ededed;
        }

        input, button {
            border: none;
            outline: none;
            background: none;
            font-family: 'Open Sans', Helvetica, Arial, sans-serif;
        }

        .cont {
            overflow: hidden;
            position: relative;
            width: 900px;
            height: 550px;
            margin: 0 auto 100px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .form {
            position: relative;
            width: 640px;
            height: 100%;
            padding: 50px 30px 0;
        }

        .sub-cont {
            overflow: hidden;
            position: absolute;
            left: 640px;
            top: 0;
            width: 900px;
            height: 100%;
            padding-left: 260px;
            background: #fff;
            transition: transform 1.2s ease-in-out;
        }

        .tip {
            font-size: 20px;
            margin: 40px auto 50px;
            text-align: center;
        }

        /* ✅ FIX 2: Button color - dark theme ke saath match karta hai */
        button.submit {
            display: block;
            margin: 30px auto 0;
            width: 260px;
            height: 42px;
            border-radius: 30px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            background: #1a1a2e;
            letter-spacing: 1px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button.submit:hover {
            background: #333366;
            transform: scale(1.03);
        }

        .img {
            overflow: hidden;
            z-index: 2;
            position: absolute;
            left: 0;
            top: 0;
            width: 260px;
            height: 100%;
            padding-top: 360px;
        }

        /* ✅ FIX 1: Dark overlay add kiya taaki text visible ho */
        .img:before {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            width: 900px;
            height: 100%;
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/142996/sections-3.jpg');
            background-size: cover;
            transition: transform 1.2s ease-in-out;
        }

        /* ✅ Dark overlay layer */
        .img:after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            width: 900px;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
        }

        .img__text {
            z-index: 3;
            position: absolute;
            left: 0;
            top: 50px;
            width: 100%;
            padding: 0 20px;
            text-align: center;
            color: #ffffff; /* ✅ White color — clearly visible now */
        }

        .img__text h2 {
            color: #ffffff;
            margin-bottom: 10px;
        }

        .img__text p {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            line-height: 1.5;
        }

        .img__btn {
            overflow: hidden;
            z-index: 3;
            position: relative;
            width: 100px;
            height: 36px;
            margin: 0 auto;
            background: transparent;
            color: #fff;
            text-transform: uppercase;
            font-size: 15px;
            cursor: pointer;
            border: 2px solid #fff;
            border-radius: 30px;
            transition: background 0.3s ease;
        }

        .img__btn:hover {
            background: rgba(255,255,255,0.2);
        }

        .img__btn span a {
            display: block;
            text-align: center;
            line-height: 36px;
            color: #fff;
            text-decoration: none;
        }

        .sign-in {
            transition-timing-function: ease-out;
        }

        .sign-up {
            transform: translate3d(-900px, 0, 0);
        }

        .sign-up-active {
            transform: translate3d(0, 0, 0);
        }

        h2 {
            width: 100%;
            font-size: 26px;
            text-align: center;
        }

        label {
            display: block;
            width: 260px;
            margin: 25px auto 0;
            text-align: center;
        }

        input {
            display: block;
            width: 100%;
            margin-top: 5px;
            padding-bottom: 5px;
            font-size: 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.4);
            text-align: center;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-bottom: 1px solid #1a1a2e;
        }

        .forgot-pass {
            margin-top: 15px;
            text-align: center;
            font-size: 12px;
            color: #cfcfcf;
        }

        .link-footer {
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
        }

    </style>
</head>
<body>
    <div class="cont">
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form sign-in">
                {{-- ✅ FIX 3: Comma remove kiya --}}
                <h2>Welcome back</h2>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required />
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required />
                </label>
                <button type="submit" class="submit">Sign In</button>
            </div>
        </form>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text">
                    <h2>New here?</h2>
                    <p>Sign up and discover great amount of new opportunities!</p>
                </div>
                <div class="img__btn">
                    <span><a href="{{ route('register') }}">Sign Up</a></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection