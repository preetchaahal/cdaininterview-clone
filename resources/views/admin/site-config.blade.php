@extends('layouts.admin')

@section('title', 'CDA Interview Admin::Site Config')

@section('extraStyles')
@endsection

@section('contentHeader')
<section class="content-header">
  	<div class="container-fluid">
	    <div class="row mb-2">
	      	<div class="col-sm-6">
	        	<h1>Site Config</h1>
	      	</div>
	      	<div class="col-sm-6">
	        	<ol class="breadcrumb float-sm-right">
	        		<li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
	          		<li class="breadcrumb-item active">Site Config</li>
	        	</ol>
	    	</div>
    	</div>
  	</div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Update site configuration</h3>

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
		                    <label for="exampleInputContactEmail">Contact Form email</label>
		                    <input type="text" class="form-control" id="exampleInputContactEmail" placeholder="Enter recipient email for Contact-us Form Query" value="{{ $contact_email }}" name="contact_email">
		              	</div>
		            </div>
		            <div class="col-md-4">
		            	<div class="form-group">
		                    <label for="exampleInputGoogleAnalyticsId">Google Analytics Tracking Id</label>
		                    <input type="text" class="form-control" id="exampleInputGoogleAnalyticsId" placeholder="Eg. XX-123456789-1" value="{{ $google_analytics_tracking_id }}" name="google_analytics_tracking_id">
		              	</div>
		            </div>
		            <div class="col-md-4">
		            	<div class="form-group">
		                    <label for="exampleInputFbPixel">Facebook Pixel Html Code</label>
		                    <textarea class="form-control" id="exampleInputFbPixel" name="fb_pixel_code">{{ $fb_pixel_code }}</textarea>
		              	</div>
		            </div>
		        </div>
            </div>
            <!-- // End of .card-body -->
            <div class="card-footer">
				<button type="submit" class="btn btn-info">Submit</button>
            </div>
      	</form>
      	<!-- //End of form -->
    </div>
</div>
@endsection

@section('extraScripts')
<script language="javascript">
$(document).ready(function (e) {
   
   	$.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
   	});
  
	$('.update_page_form').submit(function(e) {
		e.preventDefault();
   		let thisForm = $(this);
  
		var fData = new FormData(this);
  		
  		$.ajax({
	        type:'POST',
	        url: "{{ url('saveSiteConfig')}}",
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

});

</script>
@endsection