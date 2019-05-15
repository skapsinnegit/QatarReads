@extends("admin.layout.default")

@section("content")
    
    <div class="content container">
        <div class="row">
            <div class="col-md-12">
                <div class="justify-content-md-center">
                    @if($errors->has('msg'))<p class="alert {{$errors->first('class')}}"> {{ $errors->first('msg') }} </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">List Users</h5>
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
                    <th class="min-desktop">Status</th>
                    <th class="text-center max-desktop">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->first_name.' '.$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->mobile}}</td>
                        <td>{{$user->nationality}}</td>
                        <td>{{$user->childrens->count()}}</td>
                        <td>{{$user->subscriptions->count()}}</td>
                        <td>{{$user->status == 1 ? "Active" : "Inactive"}}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown dropup">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('admin.viewUsers',['id'=>encrypt($user->id)]) }}"><i class="icon-stats-dots"></i> View</a></li>
                                        <li><a href="{{ route('admin.userActiveInactive',['id'=>encrypt($user->id)]) }}" class="active-confirm"><i class=" icon-user-{{$user->status==1 ? "cancel" : "plus" }}"></i> {{$user->status==1 ? "Inactive" : "Active"}} </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
