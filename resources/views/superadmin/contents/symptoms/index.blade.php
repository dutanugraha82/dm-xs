@extends('superadmin.master')
@section('pageTitle')
    Symptoms
@endsection
@section('content')
<div class="container-fluid">
  <a href="/superadmin/symptoms/create" class="btn btn-primary mb-3">Add Symptoms <sup>+</sup></a>
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Low Score (Start)</th>
            <th>Low Score (End)</th>
            <th>High Score (start)</th>
            <th>High Score (end)</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
              <th>{{ $item->code }}</th>
              <td>{{ Str::ucfirst($item->name) }}</td>
              <td>{{ $item->low_start }}</td>
              <td>{{ $item->low_end }}</td>
              <td>{{ $item->high_start }}</td>
              <td>{{ $item->high_end }}</td>
            </tr>    
            @endforeach
        </tbody>
      </table>
</div>
@endsection