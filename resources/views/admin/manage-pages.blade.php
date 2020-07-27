@extends('layouts.admin')

@section('title', 'CDA Interview Admin::Manage Pages')

@section('extraStyles')
<meta name="robots" content="noindex">
<script src="https://cdn.tiny.cloud/1/gb4c4n89d7npmv23mnsn6s7m24stv222x8nj7sewas4egi2d/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('contentHeader')
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Manage Pages</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	        		<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
	          		<li class="breadcrumb-item active">Manage Pages</li>
	        	</ol>
	    	</div>
    	</div>
  	</div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
@foreach($pages as $page)
<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
    	<!-- form start -->
	  	<form role="form" method="post" class="update_page_form">
	  		@csrf
            <div class="card-body">
            	<div class="row">
	            	<div class="col-md-4">
		            	<div class="form-group">
		                    <label for="exampleInputMetaTitle">Meta Title</label>
		                    <input type="text" class="form-control" id="exampleInputMetaTitle" placeholder="Enter meta title" value="{{ $page->meta_title }}" name="meta_title">
		              	</div>
		          		<div class="form-group">
		                    <label for="exampleInputMetaDescription">Meta Description</label>
		                    <input type="text" class="form-control" id="exampleInputMetaDescription" placeholder="Meta Description" value="{{ $page->meta_description }}" name="meta_description">
		              	</div>
		              	<div class="form-group">
		                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
		                      <input type="checkbox" class="custom-control-input" id="customSwitch{{ $page->id }}" @if ($page->noindex == 1) checked @endif name="noindex">
		                      <label class="custom-control-label" for="customSwitch{{ $page->id }}">Block search indexing with 'noindex'</label>
		                    </div>
	                  	</div>
		            </div>
		            <div class="col-md-8">
		            	<div class="form-group">
                        	<label>HTML-Content</label>
                        	<textarea class="htmlEditor" name="html_content">{{ $page->html_content }}</textarea>
                        	<!-- <textarea class="form-control editor" rows="3" placeholder="Html content goes here..." data-content="{{ $page->html_content }}"></textarea> -->
                      	</div>
		            </div>
		        </div>
            </div>
            <!-- // End of .card-body -->
            <div class="card-footer">
            	<input type="hidden" name="id" value="{{ $page->id }}">
				<button type="submit" class="btn btn-info">Submit</button>
            </div>
      	</form>
      	<!-- //End of form -->
    </div>
</div>
@endforeach
@endsection

@section('extraScripts')
<script language="javascript">
$(document).ready(function (e) {
   
   	$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   	});
  
	$('.upload_image_form').submit(function(e) {
   		let thisForm = $(this);
		e.preventDefault();
  
		var fData = new FormData(this);
  	
	    $.ajax({
	        type:'POST',
	        url: "{{ url('photo')}}",
	        data: fData,
	        cache:false,
	        contentType: false,
	        processData: false,
	        success: (data) => {
				this.reset();
				$(thisForm).find('.profile-user-img').attr('src', data.image);
	        	alert("Image updated successfully!");
	        },
	        error: function(data){
	           console.log(data);
	        }
		});
   	});

	$('.update_page_form').submit(function(e) {
		e.preventDefault();
   		let thisForm = $(this);
  
		var fData = new FormData(this);
  		fData.set('html_content', tinymce.get(thisForm.find('textarea').attr('id')).getContent());

  		$.ajax({
	        type:'POST',
	        url: "{{ url('savePage')}}",
	        data: fData,
	        cache:false,
	        contentType: false,
	        processData: false,
	        success: (data) => {
				alert("Page updated successfully!");
	        },
	        error: function(data){
	           console.log(data);
	        }
		});
   	});

	//HTML Editor
	tinymce.init({
    	selector: '.htmlEditor',
    	branding: false
    });
});
var test;
</script>
@endsection