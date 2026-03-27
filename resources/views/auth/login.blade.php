<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input id="email" type="email" name="email" 
                   class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-underline text-secondary">
                    Forgot your password?
                </a>
            @endif

            {{-- <button type="submit" class="btn btn-primary px-5">
                Log in
            </button> --}}

            
            
        </div>

        <div class="d-flex justify-content-between mt-4">
            
            <!-- Sign Up Button -->
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                Sign up
            </a>

            <!-- Sign In Button -->
            <button type="submit" class="btn btn-primary px-5">
                Login
            </button>
        </div>
    </form>
</x-guest-layout>