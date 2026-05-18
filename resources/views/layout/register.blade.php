<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .signup-container {
            background: #fff;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .required {
            color: red;
        }

        .forgot-pass {
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Sign Up</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf
    
        <div class="form-group">
            <label for="name">Name <span class="required">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
        </div>
    
        <div class="form-group">
            <label for="phone">Phone <span class="required">*</span></label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Enter your phone number">
        </div>
    
        <div class="form-group">
            <label for="address">Address <span class="required">*</span></label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="Enter your address">
        </div>
    
        <div class="form-group">
            <label for="email">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
        </div>
    
        <div class="form-group">
            <label for="password">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" required placeholder="Create a password" autocomplete="new-password">
        </div>
    
        <div class="form-group">
            <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password" autocomplete="new-password">
        </div>
                
        <button type="submit" class="btn">Sign Up</button>
    </form>
    

    <p class="forgot-pass">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>

</body>
</html>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
