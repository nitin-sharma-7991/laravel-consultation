@extends('layouts.app')

@section('content')
<section class="py-5" style="background-color: #f5f5f5; min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <h1 class="display-6">Your Consultations</h1>
            </div>
        </div>

        @if($consultations->isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 text-center">
                    <div class="alert alert-info">
                        <p>No consultations found.</p>
                    </div>
                    <a href="{{ route('consultations.create') }}" class="btn btn-primary">Schedule a New Consultation</a>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($consultations as $consultation)
                    <div class="col-lg-6 col-md-8 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Consultation with: {{ $consultation->professional->name }}</h5>
                                <p class="card-text">
                                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($consultation->date)->format('d M, Y') }}<br>
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($consultation->time)->format('h:i A') }}<br>
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ $consultation->status == 'scheduled' ? 'success' : ($consultation->status == 'pending' ? 'warning' : ($consultation->status == 'completed' ? 'primary' : 'danger')) }}">
                                        {{ ucfirst($consultation->status) }}
                                    </span>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('consultations.edit', $consultation->id) }}" class="btn btn-warning">Edit</a>
                                    @if($consultation->status != 'cancelled')
                                        <form action="{{ route('consultations.cancel', $consultation->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
