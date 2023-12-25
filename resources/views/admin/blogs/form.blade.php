

<div class="modal right fade sidebar-modal-full-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            <form id="ajax-form" class="crud-form" enctype="multipart/form-data" method="post" action="{{ isset($model)?route('admin.blog.update', $model->id):route('admin.blog.store')}}">
                <div class="modal-body">
                    <div class="errors-list"></div>
                    <div class="message-success"></div>
                    <div class="form-full w-100">

                        @csrf
                        <input type="file" accept="image/*" id="category-image" name="image" onchange="image_preview(this)" class="d-none" />
                        <div class="image-upload-box " onclick="triggerImageUpload('#category-image')">
                            <img src="{{ isset($model) && $model->image?asset('uploads/blogs/'.$model->id.'/'.$model->image):asset('assets/img/icons/camera.png')}}" alt="" class="{{isset($model) && $model->image?'active':''}}" />
                        </div>

                        <div class="form-group mt-3">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{isset($model)?$model->name:''}}" required="">
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" name="description" placeholder="Type here..." class="form-control">{{isset($model)?$model->description:''}}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="category_id" class="control-label">Category</label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                <option value="">Select Category</option>
                                @if($categories)
                                    @foreach($categories as $category)
                                        @php
                                            $sel = '';
                                            if(isset($model) && $model->category_id == $category->id) {
                                                $sel = 'selected';
                                            }
                                        @endphp
                                    <option value="{{$category->id}}" {{$sel}} >{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0);" class="text-primary sidebar-modal-category" data-url="/admin/blog-categories/create">
                                <i class="bx bx-plus"></i>
                                Add Category
                            </a>
                        </div>
                        
                        <div class="form-group">
                            <label for="tags" class="control-label">Tags</label>
                            <textarea id="tags" name="tags" placeholder="Type here..." class="form-control">{{isset($model)?$model->tags:''}}</textarea>
                        </div>
                        

                    </div>
                    

                    

                </div>
                <div class="modal-footer">
                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-primary ajax-button">
                            <i class="bx bx-save"></i> 
                            Save Blog
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



