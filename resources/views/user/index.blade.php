@extends('layouts.user')

@section('style')
<style>
  .image-wrapper{
    border-radius: 50%;
    height: 10rem;
    background-position: center;
    width: 10rem;
    background-size: contain;
  }

  .cover{
    height: 100%;
    width: 100%;
    border-radius: 50%;
    background-color: #00000052;
    transition: 0.5s;
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .image-wrapper:hover  .cover{
    transition: 0.5s;
    opacity: 1;
    cursor: pointer;
  }

  .upload-image-heading{
    font-size: 13px;
    font-weight: 900;
    color: white;
  }


</style>

@endsection

@section('content')
<section class="content">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('store-resource')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
          <div class="card-body">
            <div class="row">
              <div class="form-group">
                <label for="fileToUpload">
                  <div class="image-wrapper" id="image-preview" style="background-image: url('https://banner2.cleanpng.com/20180410/bbw/kisspng-avatar-user-medicine-surgery-patient-avatar-5acc9f7a7cb983.0104600115233596105109.jpg')">
                    <div class="cover d-flex justify-content-center">
                        <span class="upload-image-heading">Upload Image</span>
                    </div>
                  </div>
                  <input type="File" name="profile" id="fileToUpload" class="d-none">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="firstname">Full name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" value="{{ Auth::user()->name }}">
              </div>
              <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="firstname">Phone number</label>
                <input type="text" name="phone" class="form-control" id="phone" required>
              </div>
              <div class="col-md-6 form-group">
                <label for="lastname">Address</label>
                <input type="text" name="address" class="form-control" id="address" required>
              </div>
            </div>
          @if(session('message'))
          {{ session('message') }}
          @endif
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
</section>
@endsection


@section('script')
  <script>
    $("#fileToUpload").change(function(){
      var input = this;
      console.log(input.files[0]);
      getBase64(input.files[0]).then(
        data => {
          console.log('adfasdasd');
          document.getElementById("image-preview").style.backgroundImage = "url("+data+")";
        }
      );
    });

    function getBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
      });
    }
  </script>
@endsection


