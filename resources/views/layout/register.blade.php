@extends('layout.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background: #ededed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .signup-container {
            background: #fff;
            padding: 35px 40px;
            width: 100%;
            max-width: 560px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #1a1a2e;
        }

        /* ✅ 2 column grid - page chhota ho gaya */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* Email full width */
        .form-grid .full-width {
            grid-column: 1 / -1;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 13px;
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }

        input {
            padding: 10px 12px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #1a1a2e;
            outline: none;
        }

        .required { color: red; }

        .btn {
            background-color: #1a1a2e;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            letter-spacing: 0.5px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #333366;
            transform: scale(1.02);
        }

        .signin-link {
            font-size: 13px;
            text-align: center;
            color: #777;
            margin-top: 15px;
        }

        .signin-link a {
            color: #1a1a2e;
            font-weight: 600;
            text-decoration: none;
        }

        .signin-link a:hover { text-decoration: underline; }

        /* Error messages */
        .alert {
            background: #fee;
            border: 1px solid #fcc;
            border-radius: 6px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .alert ul { padding-left: 15px; }
        .alert li { color: #c00; font-size: 13px; }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Create Account</h2>

    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Full name">
            </div>

            <div class="form-group">
                <label>Phone <span class="required">*</span></label>
                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="Phone number">
            </div>

            <div class="form-group full-width">
                <label>Address <span class="required">*</span></label>
                <input type="text" name="address" value="{{ old('address') }}" required placeholder="Your address">
            </div>

            <div class="form-group full-width">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email address">
            </div>

            <div class="form-group">
                <label>Password <span class="required">*</span></label>
                <input type="password" name="password" required placeholder="Create password" autocomplete="new-password">
            </div>

            <div class="form-group">
                <label>Confirm Password <span class="required">*</span></label>
                <input type="password" name="password_confirmation" required placeholder="Confirm password" autocomplete="new-password">
            </div>

        </div>

        <button type="submit" class="btn">Sign Up</button>
    </form>

    <p class="signin-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>

</body>
</html>
@endsection