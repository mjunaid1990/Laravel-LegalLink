

<div class="modal right fade sidebar-modal-full-style" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">{{$title}}</h5>
                <button type="button" class="btn-transparent" data-bs-dismiss="modal">
                    <i class="bx bx-chevron-left"></i>
                </button>
            </div>
            
            <div class="modal-body">
                
                <div class="d-flex">
                    <input type="file" id="importdoc" accept=".doc, .docx" style="display:none;">
                    <button type="button" class="btn btn-primary me-3" id="import_fields" onclick="$('#importdoc').trigger('click');">
                        <i class="bx bx-import"></i> 
                        Import
                    </button>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="customfields-crud-box">
                            @include('_partials/_inputs_crud')
                        </div>
                        <div class="customfields-listbox">
                            @include('admin/agreements/_inputs_listbox',['fields'=>$fields])
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="agreement-preview-wrap text-center">
                            <button type="button" class="btn btn-primary" id="agreement-preview-btn">
                                <i class="bx bx-bullseye"></i> 
                                Preview Doc
                            </button>
                            
                            <div class="agreement-preview-box">
                                @include('admin/agreements/_agreement_preview', ['model'=>$agreement])
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
                

            </div>
            <div class="modal-footer">
                <div class="w-100 text-end">
                    
                    <button type="button" class="btn btn-primary save-agreement-inputs">
                        <i class="bx bx-save"></i> 
                        Save Agreement Inputs
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var agreementId = '<?= $id; ?>';
</script>



