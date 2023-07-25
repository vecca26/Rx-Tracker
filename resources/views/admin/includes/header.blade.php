<h5>{{$moduleName}}</h5>
<div class="admin">
    <p>Hi {{ auth()->user()->name }}, Welcome back!</p>
    <img src="{{url('images/user.svg')}}" height="100vh" />
</div>