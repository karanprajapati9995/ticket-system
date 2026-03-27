<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input id="email" type="email" name="email" 
                   class="form-control" value="{{ old('email', $request->email) }}" required>
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

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="form-control" required>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-5">
                Reset Password
            </button>
        </div>
    </form>
</x-guest-layout>