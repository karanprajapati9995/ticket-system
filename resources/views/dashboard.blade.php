<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">🎟️ Ticket Dashboard</h2>
    </x-slot>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card text-center border-primary shadow-sm">
                <div class="card-body">
                    <h5 class="text-primary">Total Tickets</h5>
                    <h1 class="display-4 fw-bold text-primary">{{ $total }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="text-warning">Open</h5>
                    <h1 class="display-4 fw-bold text-warning">{{ $open }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-info shadow-sm">
                <div class="card-body">
                    <h5 class="text-info">In Progress</h5>
                    <h1 class="display-4 fw-bold text-info">{{ $inProgress }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success shadow-sm">
                <div class="card-body">
                    <h5 class="text-success">Closed</h5>
                    <h1 class="display-4 fw-bold text-success">{{ $closed }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg px-5">
            Manage All Tickets →
        </a>
    </div>
</x-app-layout>