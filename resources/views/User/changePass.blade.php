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
            @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
                @if(session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif
    <a href="{{route('user.detail')}}" class="btn btn-secondary">Detail</a>
    <form action="{{ route('user.changePass',$user) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                    <div class="col-11">
                        <input class="form-control" type="hidden" name="avatar" id="fileImage">
                    </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="fullname" value="{{$user->fullname}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="username" value="{{$user->username}}">
            </div>
            <div class="mb-3">
                <input type="hidden" class="form-control" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <input disabled type="hidden" class="form-control" name="role" value="{{$user->role}}">
            </div>
            <div class="mb-3">
                <input disabled type="hidden" class="form-control" name="active" value="@if ($user->active == 1)
Still Active
                        @else
Not Active
                        @endif">
            </div>
            <div class="mb-3">
                <h1 class="text-center">Change Pass for {{Auth::user()->fullname}}</h1>
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input type="password" class="form-control" name="oldPassword" >
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" >
            </div>
            <div class="mb-3">
                <label class="form-label">Repassword</label>
                <input type="password" class="form-control" name="rePassword" >
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Change Now</button>
            </div>
    </div>
    </form>
</body>
</html>