<h1>{{ $current_user }}</h1>
@foreach($users as $user)
    <p>{{ $user->email }}</p>
    <p>{{ $user->username}}</p>
@endforeach
