@extends('superadmin.master')
@section('pageTitle')
    Symptoms
@endsection
@section('content')
<div class="container-fluid">
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Min</th>
            <th>Max</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
              <th>{{ $item->code }}</th>
              <td>{{ Str::ucfirst($item->name) }}</td>
              <td>{{ $item->min }}</td>
              <td>{{ $item->max }}</td>
            </tr>    
            @endforeach
        </tbody>
      </table>
</div>
@endsection