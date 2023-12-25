<input type='hidden' id='docpreview' value="{{$model && $model->agreement_text?$model->agreement_text:''}}"/>
<div class="form-group">
    <div class="form-control mt-3 quill-editor">{{$model && $model->agreement_text?$model->agreement_text:''}}</div>
</div>
