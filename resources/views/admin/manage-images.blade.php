@extends('layouts.admin')

@section('title', 'CDA Interview Admin::Manage Images')

@section('extraStyles')
@endsection

@section('contentHeader')
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Manage Images</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	        		<li class="breadcrumb-item"><a href="route('admin.index')">Home</a></li>
	          		<li class="breadcrumb-item active">Manage Images</li>
	        	</ol>
	    	</div>
    	</div>
  	</div><!-- /.container-fluid -->
</section>
@endsection

@section('content')

@php
$images = [
	[
		'title'  => 'Site Logo',
		'url'    => getSiteLogo(),
		'db_key' => 'site_logo'
	],
	[
		'title'  => 'Home-page Image',
		'url'    => getHomePageImage(),
		'db_key' => 'home_page_image'
	],
	[
		'title'  => 'Contact-page Image',
		'url'    => getContactPageImage(),
		'db_key' => 'contact_page_image'
	]
];
@endphp

@foreach($images as $image)
<div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ $image['title'] }}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
    	<!-- form start -->
	  	<form role="form" method="post" enctype="multipart/form-data" class="upload_image_form" action="javascript:void(0)">
	  		@csrf
            <div class="card-body">
            	<div class="form-group">
            		<div class="text-center">
                  		<img class="profile-user-img" src="{{ $image['url'] }}" alt="{{ $image['title'] }}" style="max-width: 200px; height: auto;">
                	</div>
            	</div>
            	<div class="col-md-12 mb-2">
                    <img class="image_preview_container" src="{{ $image['url'] }}"
                        alt="preview image" style="max-width: 200px; height: auto;">
                </div>
            	<div class="form-group">
            		<input type="file" name="image" class="image">
            		<input type="hidden" name="key" value="{{ $image['db_key'] }}">
            	</div>

            	<div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- // End of .card-body -->
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
  
   	$('.image').change(function(){
	    let parent = $(this).parents('.card-body');
	    let reader = new FileReader();

	    reader.onload = (e) => { 
	      $(parent).find('.image_preview_container').attr('src', e.target.result); 
	    }

	    reader.readAsDataURL(this.files[0]); 
  
   	});
  
	$('.upload_image_form').submit(function(e) {
   		let thisForm = $(this);
		e.preventDefault();
  
		var formData = new FormData(this);
  
	    $.ajax({
	        type:'POST',
	        url: "{{ url('photo')}}",
	        data: formData,
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
});
</script>
@endsection