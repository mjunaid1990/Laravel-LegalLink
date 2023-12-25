

<div class="modal right fade sidebar-modal-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            <form id="ajax-form" class="crud-form" enctype="multipart/form-data" method="post" action="{{ isset($model)?route('admin.testimonial.update', $model->id):route('admin.testimonial.store')}}">
                <div class="modal-body">
                    <div class="errors-list"></div>
                    <div class="message-success"></div>
                    <div class="form-full w-100">

                        @csrf
                        

                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{isset($model)?$model->name:''}}" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="company" class="control-label">Company</label>
                            <input type="text" id="company" name="company" class="form-control" placeholder="Company" value="{{isset($model)?$model->company:''}}">
                        </div>


                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea id="description" name="description" placeholder="Type here..." class="form-control" required="">{{isset($model)?$model->description:''}}</textarea>
                        </div>

                    </div>
                    

                    

                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="submit" class="btn btn-primary btn-block ajax-button">
                            <i class="bx bx-save"></i> 
                            Save Testimonial
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



