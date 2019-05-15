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
                <h5 class="panel-title" style="display:inline-block;">List Editor</h5>
                @if(Auth::user()->editor_roll==1 || Auth::user()->roll == 1)
                    <a href="{{route('admin.addEditor')}}" style="display:inline-block;" class="pull-right btn btn-primary">Add Editor</a>
                @endif
            </div>
            <table class="table datatable-responsive dataTable">
                <thead>
                <tr>
                    <th class="max-desktop">Name</th>
                    <th class="max-desktop">Email</th>
                    <th class="max-desktop">Phone</th>
                    <th class="min-tablet">Assigned Program</th>
                    <th class="min-tablet">Editor Roll</th>
                    <th class="min-tablet">Status</th>
                    <th class="text-center max-desktop">Actions</th>
                </tr>
                </thead>
                <tbody>

               @foreach($editors as $editor)     
                <tr>
                    <td>{{$editor->first_name .' '.$editor->last_name}}</td>
                    <td>{{$editor->email}}</td>
                    <td>{{$editor->mobile}}</td>
                    <td>@if($editor->editor_roll==2)
                        @foreach($editor->assigned_program_names as $key => $program)
                            {{$key==0 ? $program->name : ", ".$program->name }}
                        @endforeach
                        @endif
                    </td>
                    <td>{{$editor->editor_roll==1 ? "Manage Programs & Editor" : "Manage Program"}}</td>
                    <td>{{$editor->status==1 ? "Active" : "Inactive"}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown dropup">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-menu9"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('admin.editEditor',['id'=>encrypt($editor->id)])}}"><i class="icon-pencil"></i> Edit</a></li>
                                     <li><a href="{{ route('admin.editorActiveInactive',['id'=>encrypt($editor->id)]) }}" class="active-confirm"><i class=" icon-user-{{$editor->status==1 ? "cancel" : "plus" }}"></i> {{$editor->status==1 ? "Inactive" : "Active"}} </a></li>
                                    <li><a href="{{route('admin.deleteEditor',['id'=>encrypt($editor->id)])}}" class="delete-confirm"><i class=" icon-trash"></i> Delete</a></li>
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
