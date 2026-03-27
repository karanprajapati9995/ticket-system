<x-guest-layout>
    <div class="mb-4 text-muted">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input id="password" type="password" name="password" 
                   class="form-control" required>
            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-5">
                Confirm
            </button>
        </div>
    </form>
</x-guest-layout>