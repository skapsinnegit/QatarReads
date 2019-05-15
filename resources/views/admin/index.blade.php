@extends("admin.layout.default")

@section("content")
    <div class="content container">
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat border-top-xlg border-top-info">
                    <div class="panel-heading">
                        <h6 class="panel-title">Yearly statistics</h6>
                        <div class="heading-elements">
                            <form class="heading-form" action="#">
                                <div class="form-group">
                                    <select class="change-date select-sm" id="select_date">
                                        <optgroup label="<i class='icon-watch pull-right'></i> Time period">
                                            @for($i = '2015'; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}" {{ $i == date('Y') ? "selected" : "" }}>{{ $i }}</option>
                                            @endfor
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="content-group invoice">
                                    <h5 class="text-semibold no-margin"><i class="icon-exit2 position-left"></i><span id="total-invoice">10</span></h5>
                                    <span class="text-size-small">Number of Signout</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="content-group expense">
                                    <h5 class="text-semibold no-margin"><i class="icon-bell3 position-left"></i><span id="total-expense">25</span></h5>
                                    <span class="text-size-small">Number of Subscription</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="content-group payout">
                                    <h5 class="text-semibold no-margin"><i class="icon-users4 position-left"></i><span id="total-payout">50</span></h5>
                                    <span class="text-size-small">Number of Children</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-group-sm" id="app_sales"></div>
                </div>
            </div>
        </div> --}}

        <div id="printfulStat" data-fetch-url="https://admin.bitsnpixs.com/printful-stat" class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-teal-400" style="position: static; zoom: 1;">
                    <div class="panel-body">
                        <div class="heading-elements display-block">
                            <ul class="icons-list">
                                <li>
                                    <a data-action="reload" class="refetchPrintful"></a>
                                </li>
                            </ul>
                        </div>
                        <table class="stats-table">
                            <tbody>
                                <tr>
                                    <td>{{$totalUsers}}</td>
                                </tr>
                            </tbody>
                        </table>
                        Total User
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-pink-400" style="position: static; zoom: 1;">
                    <div class="panel-body">
                        <div class="heading-elements display-block">
                            <ul class="icons-list">
                                <li>
                                    <a data-action="reload" class="refetchPrintful"></a>
                                </li>
                            </ul>
                        </div>
                        <table class="stats-table">
                            <tbody>
                                <tr>
                                    <td>{{$totalPrograms}}</td>
                                </tr>
                            </tbody>
                        </table>
                        Total Programs
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-green-600" style="position: static; zoom: 1;">
                    <div class="panel-body">
                        <div class="heading-elements display-block">
                            <ul class="icons-list">
                                <li>
                                    <a data-action="reload" class="refetchPrintful"></a>
                                </li>
                            </ul>
                        </div>
                        <table class="stats-table">
                            <tbody>
                                <tr>
                                    <td>{{$totalSubscribers}}</td>
                                </tr>
                            </tbody>
                        </table>
                        Total Subscribers
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel bg-violet-400" style="position: static; zoom: 1;">
                    <div class="panel-body">
                        <div class="heading-elements display-block">
                            <ul class="icons-list">
                                <li>
                                    <a data-action="reload" class="refetchPrintful"></a>
                                </li>
                            </ul>
                        </div>
                        <table class="stats-table">
                            <tbody>
                                <tr>
                                    <td>{{$totalUnsubscribers}}</td>
                                </tr>
                            </tbody>
                        </table>
                        Unsubscribed Users
                        <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                </div>
            </div>
        </div>


      <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Recent Users</h5>
            </div>
            <table class="table datatable-responsive">
                <thead>
                <tr>
                    <th class="max-desktop">Name</th>
                    <th class="min-tablet">Email</th>
                    <th class="min-tablet">Contact Number</th>
                    <th class="min-desktop">Nationality</th>
                    <th class="min-desktop">Number of Children</th>
                    <th class="min-desktop">Number of Subscription</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentUsers as $user)   
                    <tr>
                       <td>{{$user->first_name.' '.$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->nationality}}</td>
                        <td>{{$user->childrens->count()}}</td>
                        <td>{{$user->subscriptions->count()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>



        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Recent Subscribers</h5>
            </div>
            <table class="table datatable-responsive">
                <thead>
                <tr>
                    <th class="max-desktop">Name</th>
                    <th class="min-tablet">Email</th>
                    <th class="min-tablet">Contact Number</th>
                    <th class="min-desktop">Subscription Status</th>
                    <th class="min-desktop">Number of Children</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentSubscribers as $subscription)   
                    <tr>
                       <td>{{$subscription->users->first_name.' '.$subscription->users->last_name}}</td>
                        <td>{{$subscription->users->email}}</td>
                        <td>{{$subscription->users->mobile}}</td>
                        <td>{{$subscription->status==1 ? "Active" : "Waiting List"}}</td>
                        <td>{{$subscription->total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Recent Unsubscribers</h5>
            </div>
            <table class="table datatable-responsive">
                <thead>
                <tr>
                    <th class="max-desktop">Name</th>
                    <th class="min-tablet">Email</th>
                    <th class="min-tablet">Contact Number</th>
                    <th class="min-desktop">Subscription Status</th>
                    <th class="min-desktop">Number of Children</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentunSubscribers as $unsubscription)   
                    <tr>
                       <td>{{$unsubscription->users->first_name.' '.$unsubscription->users->last_name}}</td>
                        <td>{{$unsubscription->users->email}}</td>
                        <td>{{$unsubscription->users->mobile}}</td>
                        <td>{{$unsubscription->status==1 ? "Active" : "Waiting List"}}</td>
                        <td>{{$unsubscription->total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection