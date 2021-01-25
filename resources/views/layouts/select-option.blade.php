@foreach($records as $record)
    @if ($record->id == $current_id)
        <option selected value="{{$record->id}}">{{$record->name}}</option>
    @else
        <option value="{{$record->id}}">{{$record->name}}</option>
    @endif
@endforeach