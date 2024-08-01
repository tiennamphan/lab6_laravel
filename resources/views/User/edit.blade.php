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
    <a href="{{route('user.detail')}}" class="btn btn-secondary">Detail</a>
    <form action="{{ route('user.update',$user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <h1 class="text-center">Change Information of {{Auth::user()->fullname}}</h1>
                <label class="form-label">Avatar</label>
                <div class="row">
                    <div class="col-1">
                        <img id="img" src="{{asset('/storage/'.$user->avatar)}}" alt="" width="60">
                    </div>
                    <div class="col-11">
                        <input class="form-control" type="file" name="avatar" id="fileImage">
                    </div>
                </div>
            <div class="mb-3">
                <label for="" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" value="{{$user->fullname}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">User Name</label>
                <input type="text" class="form-control" name="username" value="{{$user->username}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Role</label>
                <input disabled type="text" class="form-control" name="role" value="{{$user->role}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Active</label>
                <input disabled type="text" class="form-control" name="active" value="@if ($user->active == 1)
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
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
    </div>
    </form>
</body>
</html>