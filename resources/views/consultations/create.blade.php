@extends('layouts.app')

@section('content')
<section class="py-5" style="background-color: #f5f5f5; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Schedule a Consultation</h3>
                    </div>
                    <div class="card-body">
                    @include('layouts.partials.messages')
                        <form action="{{ route('consultations.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="professional_id" class="form-label">Professional</label>
                                <select id="professional_id" name="professional_id" class="form-select" required>
                                    <option value="" disabled selected>Select a professional</option>
                                    @foreach($professionals as $professional)
                                        <option value="{{ $professional->id }}">
                                            {{ $professional->name }} - {{ $professional->specialty }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" id="date" name="date" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" id="time" name="time" class="form-control" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary">Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
