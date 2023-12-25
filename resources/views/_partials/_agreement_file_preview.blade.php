<input type='hidden' id='docpreview' value="{{$model && $model->agreement_text?$model->agreement_text:''}}"/>
<div class="form-group">
    <div class="mt-3 agreement-html quill-editor">{{$model && $model->agreement_text?$model->agreement_text:''}}</div>
</div>
