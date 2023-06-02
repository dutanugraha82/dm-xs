@extends('user.master')
@section('pageTitle')
    Diagnose
@endsection
@section('content')
    <div class="container-fluid">
        <h5>Check Diabetes Mellitus</h5>
        <hr class="mb-3">
            <form class="col-8" action="/diagnose" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="gdp">Jumlah Buang Air Kecil <sub class="text-danger">/hari</sub></label>
                    <input type="number" class="form-control" name="bak">
                </div>
                <div class="mb-3">
                    <label for="gds">Jumlah Rasa Lapar <sub class="text-danger">/hari</sub></label>
                    <input type="number" class="form-control" name="lapar">
                </div>
                <div class="mb-3">
                    <label for="tol_gluc">Jumlah Rasa Haus <sub class="text-danger">/hari</sub></label>
                    <input type="number" class="form-control" name="haus">
                </div>
                <div class="mb-3">
                    <label for="tol_gluc">Hasil Gula Darah Sewaktu <sub class="text-danger">mg/dL</sub></label>
                    <input type="number" class="form-control" name="gds">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
    </div>
@endsection