

<div class="modal right fade sidebar-modal-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            <form id="ajax-form" class="crud-form" enctype="multipart/form-data" method="post" action="{{ isset($model)?route('admin.category.update', $model->id):route('admin.category.store')}}">
                <div class="modal-body">
                    <div class="errors-list"></div>
                    <div class="message-success"></div>
                    <div class="form-full w-100">

                        @csrf
                        <input type="file" accept="image/*" id="category-image" name="image" onchange="image_preview(this)" class="d-none" />
                        <div class="image-upload-box " onclick="triggerImageUpload('#category-image')">
                            <img src="{{ isset($model) && $model->image?asset('uploads/categories/'.$model->id.'/'.$model->image):asset('assets/img/icons/camera.png')}}" alt="" class="{{isset($model) && $model->image?'active':''}}" />
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="category name" value="{{isset($model)?$model->name:''}}" required="">
                        </div>

                        <div class="form-group">
                            <label for="tag-color" class="control-label">Tag Colour</label>
                            <input type="text" id="tag-color" name="tag_color" placeholder="e.g red, blue" class="form-control" value="{{isset($model)?$model->tag_color:''}}" required="">
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" name="description" placeholder="Type here..." class="form-control">{{isset($model)?$model->description:''}}</textarea>
                        </div>

                    </div>
                    

                    

                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="submit" class="btn btn-primary btn-block ajax-button">
                            <i class="bx bx-save"></i> 
                            Save Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



