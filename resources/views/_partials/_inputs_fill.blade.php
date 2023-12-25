<div class="errors-list"></div>
<div class="message-success"></div>
<form id="generate-doc-form" class="customfield-form order-form" enctype="multipart/form-data" method="post" action="{{ route('generate.agreement', $model->id)}}">
    @csrf
    
    @if($fields)
        <div class="row">
        @foreach($fields as $field)
            @if($field->customfield)
                @if($field->customfield->type === 'input_email')
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="field-{{$field->customfield->id}}">{{$field->customfield->name}}</label>
                        <input type="email" id="field-{{$field->customfield->id}}" data-name="{{$field->customfield->document_name}}" class="form-control" name="custom_fields[{{$field->customfield->id}}][value]" value="" required />
                    </div>
                </div>
                @elseif($field->customfield->type === 'input_number')
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="field-{{$field->customfield->id}}">{{$field->customfield->name}}</label>
                        <input type="number" id="field-{{$field->customfield->id}}" data-name="{{$field->customfield->document_name}}" class="form-control" name="custom_fields[{{$field->customfield->id}}][value]" value="" required />
                    </div>
                </div>
                @elseif($field->customfield->type === 'input_select')
                @php
                $options = $field->customfield->options?explode(',', $field->customfield->options):'';
                @endphp
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="field-{{$field->customfield->id}}">{{$field->customfield->name}}</label>
                        <select class="form-control" id="field-{{$field->customfield->id}}" data-name="{{$field->customfield->document_name}}" name="custom_fields[{{$field->customfield->id}}][value]" required>
                            <option value="">Select...</option>
                            @if($options)
                                @foreach($options as $option)
                                    <option value="{{$option}}">{{$option}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @elseif($field->customfield->type === 'input_date')
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="field-{{$field->customfield->id}}">{{$field->customfield->name}}</label>
                        <input type="date" id="field-{{$field->customfield->id}}" data-name="{{$field->customfield->document_name}}" class="form-control" name="custom_fields[{{$field->customfield->id}}][value]" value="" required />
                    </div>
                </div>
                @else
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="field-{{$field->customfield->id}}">{{$field->customfield->name}}</label>
                        <input type="text" id="field-{{$field->customfield->id}}" data-name="{{$field->customfield->document_name}}" class="form-control" name="custom_fields[{{$field->customfield->id}}][value]" value="" required />
                    </div>
                </div>
                @endif
            @endif
        @endforeach
        </div>
    @endif
    
    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary active" style="width: 200px;max-width: 100%;">
            Save Input
        </button>
    </div>
    
</form>