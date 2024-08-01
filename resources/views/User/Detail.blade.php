<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm phim</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    @auth
        <div class="div">
            User : {{Auth::user()->fullname}}
            <a href="{{route('logout')}}">Logout</a>
        </div>
    @endauth
            <div class="mb-3">
                <h1 class="text-center">Information of {{Auth::user()->fullname}}</h1>
                <label class="form-label">Avatar</label>
                    <div class="col-1">
                        <img id="img" src="{{asset('/storage/'.$user->avatar)}}" alt="" width="60">
                     </div>
            <div class="mb-3">
                <label for="" class="form-label">Full Name</label>
                <input disabled type="text" class="form-control" name="title" value="{{$user->fullname}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">User Name</label>
                <input disabled type="text" class="form-control" name="title" value="{{$user->username}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input disabled type="text" class="form-control" name="title" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Role</label>
                <input disabled type="text" class="form-control" name="title" value="{{$user->role}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Active</label>
                <input disabled type="text" class="form-control" name="title" value="@if ($user->active == 1)
Still Active
                        @else
Not Active
                        @endif">
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">Image</label>
                <div class="row">
                    <div class="col-1">
                        <img id="img" src="{{asset('/storage/'.$post->image)}}" alt="" width="60">
                    </div>
                    <div class="col-11">
                        <input class="form-control" type="file" name="image" id="fileImage">
                    </div>
                </div>

 --}}
            <div class="mb-3">
                <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('user.changePass', $user) }}" class="btn btn-primary">Change Pass</a>
            </div>
    </div>
</body>
</html>