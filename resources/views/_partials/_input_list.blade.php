
@if($field)

@php
$checked = '';
if($field && $field->assign && $field->assign->custom_field_id) {
    $checked = 'checked';
}
@endphp

<li class="list-{{$field->id}}">
    <div class="form-check mb-2 custom-field-checkbox">
        <input class="form-check-input" type="checkbox" value="{{$field->id}}" data-name="{{$field->document_name}}" data-id="{{$field->id}}" id="defaultCheck-{{$field->id}}" {{$checked}} >
        <label class="form-check-label" for="defaultCheck-{{$field->id}}">
            {{$field->name}} - {{$field->document_name}}
        </label>
    </div>
    <div class="action ms-3">
        <a href="javascript:void(0)" class="me-1 cursor-pointer edit-customfield-ajax-form" data-id="{{$field->id}}">
            <i class="bx bx-pencil"></i>
        </a>
        <a href="javascript:void(0)" class="text-danger cursor-pointer delete-custom-field-form" data-id="{{$field->id}}">
            <i class="bx bx-trash-alt"></i>
        </a>
    </div>
</li>
@endif