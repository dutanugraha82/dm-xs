@extends('superadmin.master')
@section('pageTitle')
    symptoms-create
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card p-3">
            <h4>Form create symptoms diabetes</h4>
            <hr>
            <form action="{{ route('superadmin.symptoms.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="code">Symptoms Code</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>
                    </div>
                
               <div class="col-md-6">
                <div class="mb-4">
                    <h5>Low Score</h5>
                    <div class="mb-3">
                        <label for="min">Start score</label>
                        <input type="number" class="form-control" step="0.01" name="lowStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="max">End Score</label>
                        <input type="number" class="form-control" step="0.01" name="lowEnd" required>
                    </div>
                </div>
                <div class="mb-4">
                    <h5>High score</h5>
                    <div class="mb-3">
                        <label for="min">Start score</label>
                        <input type="number" class="form-control" step="0.01" name="highStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="max">End Score</label>
                        <input type="number" class="form-control" step="0.01" name="highEnd" required>
                    </div>
                </div>
               </div>
            </div>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
@endsection
