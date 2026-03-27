<x-guest-layout>
    <div class="mb-4 text-muted">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to the email address you provided.
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>