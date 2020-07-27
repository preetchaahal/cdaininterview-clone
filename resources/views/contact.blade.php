@extends('layouts.app-front')

@section('title', 'FREE Ultimate Guide to CDA Interviews: Tips & Proven Strategies to Help You Prepare & Ace Your CDA Structured Interview.')

@section('content')
<!-- Header Section -->
<header class="contact-head" style="background-image: url('{{ getContactPageImage()  }}');">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
    </div>
  </div>
</header>
<!-- End of Header Section -->

<!-- Main Content Section -->
<div class="container p-5">
    
    {!! getContactPageHtml() !!}

    <form role="form" method="post" class="contact_page_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputTextarea">How can we help you?</label>
            <textarea class="form-control" id="exampleInputTextarea" name="message"></textarea>
        </div>
        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <p class="pt-2 text-dark font-weight-bold">Note: If you are having difficulties with our contact us form above, send us an email to info@bemoacademicconsulting.com (copy & paste the email address)</p>
</div>
<!-- End of Main Content Section -->
@endsection

@section('extraScripts')
<script type="text/javascript">

    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.contact_page_form').submit(function(e) {
        e.preventDefault();
        
        var fData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "{{ url('contactForm')}}",
            data: fData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                alert("We have received your query and we will get back to you soon!");
            },
            error: function(data){
               console.log(data);
            }
        });
    });
</script>
@endsection