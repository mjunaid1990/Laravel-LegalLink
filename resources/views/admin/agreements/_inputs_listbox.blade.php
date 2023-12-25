<div class="cf-lists">
    <h6 style="font-weight: 700;">Assign Inputs</h6>
    <ul>
        @if($fields)
            @foreach($fields as $field)
                @include('_partials/_input_list',['field'=>$field])
            @endforeach
        @endif
    </ul>
</div>