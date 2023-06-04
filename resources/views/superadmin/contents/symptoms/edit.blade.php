@extends('superadmin.master')
@section('pageTitle')
    update-data
@endsection
@section('content')
<div class="container-fluid">
    <div class="card p-3">
        <h4>Edit {{ $data->name }} symptoms</h4>
        <hr>
        <form action="/superadmin/symptoms/{{ $data->id }}" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="code">Symptoms Code</label>
                        <input type="text" class="form-control" name="code" value="{{ $data->code }}" required>
                    </div>
                </div>
            
           <div class="col-md-6">
            <div class="mb-4">
                <h5>Low Score</h5>
                <div class="mb-3">
                    <label for="min">Start score</label>
                    <input type="number" class="form-control" step="0.01" value="{{ $data->low_start }}" name="lowStart" required>
                </div>
                <div class="mb-3">
                    <label for="max">End Score</label>
                    <input type="number" class="form-control" step="0.01" value="{{ $data->low_end }}" name="lowEnd" required>
                </div>
            </div>
            <div class="mb-4">
                <h5>High score</h5>
                <div class="mb-3">
                    <label for="min">Start score</label>
                    <input type="number" class="form-control" step="0.01" value="{{ $data->high_start }}" name="highStart" required>
                </div>
                <div class="mb-3">
                    <label for="max">End Score</label>
                    <input type="number" class="form-control" step="0.01" value="{{ $data->high_end }}" name="highEnd" required>
                </div>
            </div>
           </div>
        </div>
            <button type="submit" class="btn btn-primary mt-4" onclick="return confirm('Yakin ingin merubah data?')">Update</button>
        </form>
    </div>
</div>
@endsection