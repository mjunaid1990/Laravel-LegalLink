

<div class="modal right fade sidebar-modal-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            <form id="ajax-form" class="crud-form" enctype="multipart/form-data" method="post" action="{{ isset($model)?route('admin.customfield.update', $model->id):route('admin.customfield.store')}}">
                <div class="modal-body">
                    <div class="errors-list"></div>
                    <div class="message-success"></div>
                    <div class="form-full w-100">

                        @csrf
                        
                        
                        @include('_partials/_inputs_crud_modal')

                    </div>
                    

                    

                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <button type="submit" class="btn btn-primary btn-block ajax-button">
                            <i class="bx bx-save"></i> 
                            Save Input
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



