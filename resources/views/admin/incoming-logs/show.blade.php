@extends('admin.layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Incoming Log Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Source:</strong>
                        <p class="text-muted">{{ $incomingLog->source }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Title:</strong>
                        <p class="text-muted">{{ $incomingLog->title }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Word Count:</strong>
                        <p class="text-muted">{{ $incomingLog->word_count }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Created At:</strong>
                        <p class="text-muted">{{ $incomingLog->created_at->format('d M, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
