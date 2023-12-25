

<div class="modal right fade sidebar-modal-full-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            <form id="ajax-form" class="crud-form" enctype="multipart/form-data" method="post" action="{{ isset($model)?route('admin.agreement.update', $model->id):route('admin.agreement.store')}}">
                <div class="modal-body">
                    <div class="errors-list"></div>
                    <div class="message-success"></div>
                    <div class="form-full w-100">

                        @csrf
                        <input type="file" accept="image/*" id="category-image" name="image" onchange="image_preview(this)" class="d-none" />
                        
                        <div class="row mb-3">
                            <div class="col-12 col-md-4">
                                <div class="image-upload-box " onclick="triggerImageUpload('#category-image')">
                                    <img src="{{ isset($model) && $model->image?asset('uploads/agreements/'.$model->id.'/'.$model->image):asset('assets/img/icons/camera.png')}}" alt="" class="{{isset($model) && $model->image?'active':''}}" />
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Agreement name" value="{{isset($model)?$model->name:''}}" required="">
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
                                    <label for="language" class="control-label">Language</label>
                                    <select class="form-control" name="language" id="language">
                                        <option value="">Select Language</option>
                                        <option value="english" {{isset($model) && $model->language == 'english'?'selected':''}} >English</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="page_count" class="control-label">Page Count</label>
                                    <input type="number" id="page_count" name="page_count" class="form-control" placeholder="Page Count" value="{{isset($model)?$model->page_count:''}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="date" class="control-label">Date</label>
                                    <input type="date" id="date" name="date" class="form-control" placeholder="Date" value="{{isset($model)?$model->date:''}}">
                                </div>
                                
                                <div class="form-group ms-2">
                                        <label for="status" class="control-label">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="hidden" {{isset($model) && $model->status == 'hidden'?'selected':''}}>Hidden</option>
                                            <option value="draft" {{isset($model) && $model->status == 'draft'?'selected':''}}>Draft</option>
                                            <option value="published" {{isset($model) && $model->status == 'published'?'selected':''}}>Published</option>
                                        </select>
                                    </div>
                                
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="form-group">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea id="description" name="description" placeholder="Type here..." class="form-control">{{isset($model)?$model->description:''}}</textarea>
                                </div>
                                
                                <div class="d-flex">
                                    
                                    <div class="form-group">
                                        <label for="regular_price" class="control-label">Price</label>
                                        <input type="number" step="any" id="regular_price" name="regular_price" class="form-control" placeholder="Price" value="{{isset($model)?$model->regular_price:''}}">
                                    </div>
                                    <div class="form-group ms-2">
                                        <label for="sale_price" class="control-label">Sale Price</label>
                                        <input type="number" step="any" id="sale_price" name="sale_price" class="form-control" placeholder="Sale Price" value="{{isset($model)?$model->sale_price:''}}">
                                    </div>
                                    <div class="form-group ms-2">
                                        <label for="promotion_id" class="control-label">Promotion</label>
                                        <select class="form-control" name="promotion_id" id="promotion_id" required>
                                            <option value="">Select Promotion</option>
                                            @if($promotions)
                                                @foreach($promotions as $promo)
                                                @php
                                                $sel = '';
                                                if(isset($model) && $model->promotion_id == $promo->id) {
                                                    $sel = 'selected';
                                                }
                                                @endphp
                                                <option value="{{$promo->id}}" {{$sel}}>{{$promo->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="d-flex">
                                    
                                    <div class="form-check form-group">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" {{isset($model) && $model->is_featured == 1?'checked':''}}>
                                        <label class="form-check-label" for="is_featured">
                                          Featured
                                        </label>
                                    </div>
                                    <div class="form-check form-group ms-3">
                                        <input class="form-check-input" type="checkbox" name="is_recomended" value="1" id="is_recomended" {{isset($model) && $model->is_recomended == 1?'checked':''}}>
                                        <label class="form-check-label" for="is_recomended">
                                          Recommended
                                        </label>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label for="description" class="control-label">Search Tags</label>
                                    <textarea id="tags" name="tags" placeholder="Type here..." class="form-control">{{isset($model)?$model->tags:''}}</textarea>
                                    <p><small>Note(add comma separated values e.g. one,two,three)</small></p>
                                </div>
                                
                            </div>
                        </div>


                    </div>
                    

                    

                </div>
                <div class="modal-footer">
                    <div class="w-100 text-end">
                        
                        @if(isset($model) && !empty($model->id))
                            <button type="button" class="btn btn-primary" id="agreement-input-modal" data-id="{{$model->id}}">
                                Agreement Inputs
                            </button>
                        @else
                        <div id="add-agreement-inputs"></div>
                        @endif
                        
                        <button type="submit" class="btn btn-primary ajax-button">
                            <i class="bx bx-save"></i> 
                            Save Agreement
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



