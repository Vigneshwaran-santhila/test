@foreach($todos as $todo)
    <li id="{{$todo->id}}">
        
        <li id="span_{{$todo->id}}">{{$todo->category}}</li>
        <li id="span_{{$todo->id}}">{{$todo->remarks}}</li>
        
    </li>
@endforeach