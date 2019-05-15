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
                    <h5 class="panel-title" style="display:inline-block;">List Programs</h5>
                    @if(Auth::user()->editor_roll==1 || Auth::user()->roll == 1)
                         <a href="{{route('admin.addProgram')}}" style="display:inline-block;" class="pull-right btn btn-primary">Add Program</a>
                    @endif
            </div>
            <table class="table datatable-responsive">
                <thead>
                <tr>
                    <th class="max-desktop">Sl.No</th>
                    <th class="max-desktop">Name</th>
                    <th class="min-tablet">Age Limit</th>
                    <th class="min-tablet">One Time Setup Cost</th>
                    <th class="min-desktop">Monthly Recurring Cost</th>
                    <th class="min-desktop">Status</th>
                    <th class="text-center max-desktop">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($programs as $key => $program)    
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$program->name}}</td>
                    <td>{{$program->start_age .' to '.$program->end_age}}</td>
                    <td>{{$program->cost}} QAR/User</td>
                    <td>{{$program->recurring_cost}} QAR/User</td>
                    <td>{{$program->status==1 ? "Active" : "Inactive"}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown dropup">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('admin.editProgram',['id'=>encrypt($program->id)])}}"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="{{ route('admin.programActiveInactive',['id'=>encrypt($program->id)]) }}" class="active-confirm"><i class=" icon-{{$program->status==1 ? "cancel-circle2" : "plus-circle2" }}"></i> {{$program->status==1 ? "Inactive" : "Active"}} </a></li>
                                    <li><a href="{{route('admin.deleteProgram',['id'=>encrypt($program->id)])}}" class="delete-confirm"><i class=" icon-trash"></i> Delete</a></li>
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
