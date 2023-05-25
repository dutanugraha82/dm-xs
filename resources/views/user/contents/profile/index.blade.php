@extends('user.master')
@section('pageTitle')
    Profile {{ auth()->user()->name }}
@endsection
@section('content')
{{-- @dd($data->count()) --}}
    <div class="card p-3">
        <div class="my-3">
            <h5>Your Profile</h5>
            <hr>
        </div>
       @if($data->count() > 0)
       <form action="/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
           @csrf
           @method('put')
           <div class="row">
               <div class="col-md-6">
            @foreach ($data as $item)
                   <div class="mb-3">
                       <label for="">Name</label>
                       <input type="text" class="form-control"  value="{{ $item->user->name }}" readonly>
                    </div>
                <div class="mb-3">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $item->phone }}" required>
                </div>
                <div class="mb-3">
                    <label for="">Photo Profile</label><br>
                    @if ($item->photo)
                    <img src="{{ asset('/storage'.'/'.$item->photo) }}" class="mb-3" style="width: 200px" alt="">
                    @endif
                    <img class="img-preview" class="mb-3" style="width:200px"  alt=""><br>
                    <input type="file" style="width: 20rem" name="photo" id="image" onchange="imgPreview()">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="">Birthday</label>
                    <input type="date" name="birthday" class="form-control" value="{{ $item->birthday }}" required>
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                     <textarea name="address" class="form-control" required>{{ $item->address }}</textarea>
                </div>
            </div>
            @endforeach
           </div>
           <button type="submit" class="btn btn-primary mt-4 mb-3 d-block ml-auto" style="width: 10rem" onclick="return confirm('Update your data?')">Update</button>
       </form>
        @else
        <form action="/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Photo Profile</label><br>
                        <img class="img-preview" class="col-5 rounded-circle"  alt="">
                        <input type="file" style="width: 20rem" name="photo" id="image" onchange="imgPreview()">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="">Birthday</label>
                        <input type="date" name="birthday" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                         <textarea name="address" class="form-control" required></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4 mb-3 d-block ml-auto" style="width: 10rem">Submit</button>
        </form>
        @endif
    </div>
@endsection
@push('js')
    <script>
         function imgPreview()
        {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush