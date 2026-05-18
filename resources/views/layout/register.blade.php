@extends('layout.layout')

@section('content')
<style>
    *, *:before, *:after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .register-wrapper {
        background: #ededed;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
    }

    .cont {
        overflow: hidden;
        position: relative;
        width: 900px;
        height: 560px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        display: flex;
    }

    /* Left side - Form */
    .form-side {
        width: 60%;
        height: 100%;
        padding: 40px 45px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-side h2 {
        font-size: 26px;
        text-align: center;
        color: #1a1a2e;
        margin-bottom: 25px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    label {
        font-size: 12px;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    input {
        padding: 9px 12px;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.3);
        font-size: 14px;
        color: #333;
        background: transparent;
        transition: border-color 0.3s ease;
        font-family: 'Open Sans', Arial, sans-serif;
    }

    input:focus {
        outline: none;
        border-bottom: 1px solid #1a1a2e;
    }

    .required { color: red; }

    .btn-submit {
        display: block;
        margin: 22px auto 0;
        width: 200px;
        height: 40px;
        border-radius: 30px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        background: #1a1a2e;
        border: none;
        letter-spacing: 1px;
        transition: background 0.3s ease, transform 0.2s ease;
        font-family: 'Open Sans', Arial, sans-serif;
    }

    .btn-submit:hover {
        background: #333366;
        transform: scale(1.03);
    }

    .signin-link {
        font-size: 12px;
        text-align: center;
        color: #777;
        margin-top: 12px;
    }

    .signin-link a {
        color: #1a1a2e;
        font-weight: 600;
        text-decoration: none;
    }

    /* Right side - Image */
    .img-side {
        width: 40%;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .img-side:before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/142996/sections-3.jpg');
        background-size: cover;
        background-position: center;
    }

    .img-side:after {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.55);
    }

    .img-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 30px 25px;
        text-align: center;
    }

    .img-content h2 {
        color: #fff;
        font-size: 24px;
        margin-bottom: 12px;
    }

    .img-content p {
        color: rgba(255,255,255,0.85);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .img-btn {
        width: 110px;
        height: 36px;
        border: 2px solid #fff;
        border-radius: 30px;
        background: transparent;
        cursor: pointer;
        transition: background 0.3s ease;
        padding: 0;
    }

    .img-btn:hover { background: rgba(255,255,255,0.2); }

    .img-btn a {
        display: block;
        line-height: 32px;
        text-align: center;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        font-family: 'Open Sans', Arial, sans-serif;
    }

    .alert {
        grid-column: 1 / -1;
        background: #fee;
        border: 1px solid #fcc;
        border-radius: 6px;
        padding: 8px 12px;
    }
    .alert li { color: #c00; font-size: 12px; list-style: none; }
</style>

<div class="register-wrapper">
    <div class="cont">

        <!-- Left: Form -->
        <div class="form-side">
            <h2>Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-grid">

                    @if ($errors->any())
                        <div class="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

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

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>

            <p class="signin-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </div>

        <!-- Right: Image -->
        <div class="img-side">
            <div class="img-content">
                <h2>Already a member?</h2>
                <p>Sign in and continue sharing your amazing ideas with the world!</p>
                <button class="img-btn">
                    <a href="{{ route('login') }}">Sign In</a>
                </button>
            </div>
        </div>

    </div>
</div>

@endsection