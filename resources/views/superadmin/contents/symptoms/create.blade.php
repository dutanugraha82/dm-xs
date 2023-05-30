@extends('superadmin.master')
@section('pageTitle')
    symptoms-create
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card p-3 col-7">
            <h4>Form create symptoms diabetes</h4>
            <hr>
            <form action="{{ route('superadmin.symptoms.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="code">Symptoms Code</label>
                    <input type="text" class="form-control" name="code" required>
                </div>
                <div class="mb-3">
                    <label for="min">Minimum Score</label>
                    <input type="number" class="form-control" name="min" required>
                </div>
                <div class="mb-3">
                    <label for="max">Maximal Score</label>
                    <input type="number" class="form-control" name="max" required>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
@endsection
