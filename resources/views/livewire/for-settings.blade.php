<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <h1>{{$name}}</h1>
    <h2>{{$position}}</h2>

    @foreach($accessStatuses as $accessStatus)
        <label>{{$accessStatus['page']}}: {{$accessStatus['status']}}</label>
        <br><br>
    @endforeach
</div>