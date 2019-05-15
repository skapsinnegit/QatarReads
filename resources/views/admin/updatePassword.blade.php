@extends("admin.layout.default")

@section("content")
    <!-- Content area -->
    <div class="content container">
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content">
                    <!-- Page container -->
                    <div class="page-container login-container">

                        <!-- Page content -->
                        <div class="page-content">

                            <!-- Main content -->
                            <div class="content-wrapper">

                                <!-- Content area -->
                                <div class="content">

                                    <!-- Registration form -->
                                    <form action="{{ route('admin.updatePassword') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-lg-6 col-lg-offset-3">
                                                <div class="panel registration-form">
                                                    <div class="panel-body">
                                                        <div class="text-center">
                                                            <div class="icon-object border-success text-success"><i class="icon-key"></i></div>
                                                            <h5 class="content-group-lg">Update Password</h5>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <input type="text" class="form-control" placeholder="Name" name="name">
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-user text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-user-lock text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <input type="password" class="form-control" placeholder="New password" name="password">
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-user-lock text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group has-feedback">
                                                                    <input type="password" class="form-control" placeholder="Repeat password" name="password_confirmation">
                                                                    <div class="form-control-feedback">
                                                                        <i class="icon-user-lock text-muted"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="text-right">
                                                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-lock2"></i></b>Update Password</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /registration form -->

                                </div>
                                <!-- /content area -->

                            </div>
                            <!-- /main content -->

                        </div>
                        <!-- /page content -->

                    </div>
                </div>
            </div>
        </div>
@endsection