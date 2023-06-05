@extends('user.master')
@section('pagetitle')
    hasil-sistem
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card p-3">
            <h4>Hasil Diagnosa</h4>
            <hr>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="{{ auth()->user()->name  }}" readonly>
            </div>
            <div class="mb-3">
                <label for="status">Status</label>
                <input type="text" class="form-control" value="{{ $data->status_dm }}" readonly>
            </div>
            <div class="mb-3">
                <label for="conclusion">Kesimpulan dan Saran</label>
                <p>{!! $data->conclusion !!}</p>
            </div>
        </div>
    </div>
@endsection
