
<div class="form-group">
    <label for="name" class="control-label">Input Name</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Input Name" value="{{isset($model)?$model->name:''}}" required="">
</div>
<div class="form-group">
    <label for="document_name" class="control-label">Tag in document</label>
    <input type="text" id="document_name" name="document_name" class="form-control" placeholder="{input_tag}" value="{{isset($model)?$model->document_name:''}}" required="">
</div>
<div class="form-group">
    <label for="description" class="control-label">Description</label>
    <textarea id="description" name="description" placeholder="Type here..." class="form-control">{{isset($model)?$model->description:''}}</textarea>
</div>

<div class="form-group">
    <label for="field_type" class="control-label">Input Type</label>
    <select name="field_type" class="form-control">
        <option value="">Select field type</option>
        <option value="input_text" {{isset($model) && $model->field_type == 'input_text'?'selected':''}}>Text</option>
        <option value="input_number" {{isset($model) && $model->field_type == 'input_number'?'selected':''}}>Number</option>
        <option value="input_select" {{isset($model) && $model->field_type == 'input_select'?'selected':''}}>Select</option>
        <option value="input_date" {{isset($model) && $model->field_type == 'input_date'?'selected':''}}>Date</option>
    </select>
</div>
<div class="form-group d-none field-type-select">
    <label for="field_options" class="control-label">Options</label>
    <textarea id="field_options" name="field_options" placeholder="e.g. name,name2,name3" class="form-control">{{isset($model)?$model->field_options:''}}</textarea>
    <p class="m-0"><small>Add comma separated values in above field</small></p>
</div>
