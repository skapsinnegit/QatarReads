@extends("admin.layout.default")

@section("content")
   
    <div class="content container">
        <div class="panel">
            <div class="panel-heading">
                <i class="fa fa-bar-chart"></i>User Details
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sub-panel">
                            <div class="row align-items-center title-section">
                                <div class="col-sm-6"><h3 class="title">User Details</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="data-table data-table table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>Name: </b></td>
                                                <td>{{$user->first_name.' '.$user->last_name}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email: </b></td>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Contact Number: </b></td>
                                                <td>{{$user->mobile}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Nationality: </b></td>
                                                <td>{{$user->nationality}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Number of Children: </b></td>
                                                <td>{{$user->childrens->count()}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Number of Active Subscription: </b></td>
                                                <td>{{$user->subscriptions->where('status',1)->count()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sub-panel">
                            <div class="row align-items-center title-section">
                                <div class="col-sm-6"><h3 class="title">Subscription List</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(! empty($user->subscriptions->where('status',1)[0]))
                                    <table class="data-table data-table table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($user->subscriptions->where('status',1) as $subscription) 
                                            <tr>
                                                <td>{{$subscription->programs->name}}</td>
                                                <td>{{$subscription->programs->recurring_cost}} QAR/User</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                        No subscription available
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sub-panel">
                            <div class="row align-items-center title-section">
                                <div class="col-sm-6"><h3 class="title">Children List</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(! empty($user->childrens[0]))
                                    <table class="data-table data-table table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date of Birth</th>
                                                <th>Gender</th>
                                                <th>Institution</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->childrens as $child)
                                            <tr>
                                                <td>{{$child->name}}</td>
                                                <td>{{$child->dob}}</td>
                                                <td>{{$child->gender}}</td>
                                                <td>{{$child->institution}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    No children
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
