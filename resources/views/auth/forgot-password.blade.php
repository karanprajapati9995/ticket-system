<x-guest-layout>
    <div class="mb-4 text-muted">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input id="email" type="email" name="email" 
                   class="form-control" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-5">
                Email Password Reset Link
            </button>
        </div>
    </form>
</x-guest-layout>