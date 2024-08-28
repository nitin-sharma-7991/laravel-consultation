@extends('layouts.app')

@section('content')
<section class="dashboard py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <h2 class="mb-4">Welcome, {{ Auth::user()->name }}</h2>
                        <a href="{{ route('consultations.create') }}" class="btn btn-primary">Schedule a New Consultation</a>
                         <!-- Logout Button -->
                         <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>


                <!-- Search and Filter Form -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <form action="{{ route('dashboard') }}" method="GET" class="form-inline">
                            <div class="form-group mx-2 mb-2">
                                <label for="date" class="mr-2">Date:</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                            </div>
                            <div class="form-group mx-2 mb-2">
                                <label for="professional" class="mr-2">Professional:</label>
                                <input type="text" name="professional" id="professional" class="form-control" placeholder="Professional Name" value="{{ request('professional') }}">
                            </div>
                            <div class="form-group mx-2 mb-2">
                                <label for="specialty" class="mr-2">Specialty:</label>
                                <input type="text" name="specialty" id="specialty" class="form-control" placeholder="Specialty" value="{{ request('specialty') }}">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2 ml-2">Reset</a>
                        </form>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <h4 class="mb-3">Your Upcoming Consultations</h4>
                        @if ($consultations->isEmpty())
                            <div class="alert alert-info text-center">No upcoming consultations.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Schedule Date</th>
                                            <th>Schedule Time</th>
                                            <th>Professional</th>
                                            <th>Status</th>
                                            <th>Scheduled At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($consultations as $consultation)
                                            <tr>
                                                <td>{{ $consultation->date }}</td>
                                                <td>{{ $consultation->time }}</td>
                                                <td>{{ $consultation->professional->name }} - {{ $consultation->professional->specialty }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $consultation->status == 'cancelled' ? 'danger' : 'success' }}">
                                                        {{ ucfirst($consultation->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('consultations.edit', $consultation) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @if($consultation->status != 'cancelled')
                                                        <form action="{{ route('consultations.cancel', $consultation) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
