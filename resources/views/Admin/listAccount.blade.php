<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh sách bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
    <h1 class="text-center pb-4">List of Account</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}    
        </div>
    @endif


    @auth
        <div class="div">
            Admin : {{Auth::user()->fullname}}
            <a href="{{route('logout')}}">Logout</a>
        </div>
    @endauth
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Avatar</th>
                <th scope="col">Role</th>
                <th scope="col">Active</th>
                <th scope="col">Disable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->fullname }}</td>
                    {{-- <td>
                        <img src="{{ asset('/storage/' . $user->image) }}" width="50" alt="">
                    </td> --}}
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    {{-- <img src="storage/app/{{$user->avatar }}" width="50" alt=""> --}}
                    <td>{{ $user->avatar }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->active == 1)
                            Still Active
                        @else
                            Not Active
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('account.setAble', $user) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="fullname" value="{{ $user->fullname }}">
                            <input type="hidden" name="username" value="{{ $user->username }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="password" value="{{ $user->password }}">
                            <input type="hidden" name="avatar" value="{{ $user->avatar }}">
                            <input type="hidden" name="role" value="{{ $user->role }}">
                            <input type="hidden" name="active" value="{{ $user->active }}">
                            @if ($user->active == 1)
                               <button type="submit" class="btn btn-danger" > Off</button> 
                               {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Sure???')">On</button>  --}}
                            @endif
                            @if ($user->active == 0)
                               <button type="submit" class="btn btn-success">On</button> 
                               {{-- <button type="submit" class="btn btn-success" onclick="return confirm('Sure???')">Off</button>  --}}
                            @endif
                            
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
    </div>
</body>

</html>
