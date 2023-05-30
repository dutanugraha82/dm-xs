@extends('user.master')
@section('pageTitle')
    Diagnose
@endsection
@section('content')
    <div class="container-fluid">
        <h5>Check Diabetes Mellitus</h5>
        <hr class="mb-3">
            <form class="col-8" action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="gdp">Gula Darah Puasa</label>
                    <input type="number" class="form-control" name="gdp">
                </div>
                <div class="mb-3">
                    <label for="gds">Gula Sewaktu</label>
                    <input type="number" class="form-control" name="gds">
                </div>
                <div class="mb-3">
                    <label for="tol_gluc">Toleransi Glukosa</label>
                    <input type="number" class="form-control" name="tol_gluc">
                </div>
                <div class="mb-3">
                    <label for="HbA1C">Hasil HbA1C</label>
                    <input type="number" class="form-control" name="HbA1C">
                </div>

                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
    </div>
@endsection