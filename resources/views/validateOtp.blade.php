@extends("layout.default")

@section("content")
    <section class="section-padding auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <form method="post" action="{{ routex('validateOtp') }}">
                        {{ csrf_field() }}
                        <div class="w-100 justify-content-md-center">
                            <div class="col-md-12">
                                <h3 class="heading text-center">Validate One Time Password</h3>
                            </div>
                           
                                <div class="form-group">
                                    <label for="email"> </label>

                                    <input type="hidden" name="id" value="{{$id}}" />
                                    <input type="text" name="otp" placeholder="Secret Code" class="form-control"  />
                                </div>



                            <div class="w-100 justify-content-md-center">
                             <p style="margin-top:20px;" class="alert alert-success">  Enter 6 digit One Time Password that you have received in your registered email id </p>
                            </div>


                             <button class="btn primary-btn submit d-block w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection