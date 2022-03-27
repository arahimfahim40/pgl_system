<div class="modal fade" id="edit_user{{$user->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">User Register Form</h4>
            </div>
            <form action="{{url('edit_user_admin')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                 <input type="hidden" name="id" value="{{$user->id}}" />
                  <input type="hidden" name="usert" value="{{$user->type_id}}">
            <div class="modal-body">
                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                    <label for="email">Username *</label>
                    <input type="text" name="username" id="email" class="form-control" placeholder="enter user name" value="{{$user->username}}" />
                </div>
                    <div class="form-group col-md-6 col-xs-12 col-lg-6">
                        <label for="email">User Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter user email" value="{{$user->email}}" />
                    </div>
                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                    <label for="password">User Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="enter user password" />
                </div>
                <div class="form-group col-md-6 col-xs-12 col-lg-6">
                    <label for="file">Choose Photo *</label><br>
                    <input type="file" name="photo" id="file" class="form-control"/>
                </div>
                <div class="form-group" >
                    <!-- Restricted User Access -->
                    @if($user->type=='user')
                    <div>
                        &nbsp;&nbsp;&nbsp;<b> Choose Access Pages</b>
                        <div class="panel-body" style="margin:3%">
                                <?php $permissions = DB::table('permissions')
                                ->where('relate','=','0')->get(); ?>
                                @foreach($permissions as $per)
                                    @if($per->main == 1)
                                        <?php continue; ?>
                                    @endif
                                    <?php $user_permission= DB::table('permission_user')
                                    ->where('permission_id',"=",$per->id)
                                    ->where('user_id','=',$user->id)->first(); ?>
                                    @if($user_permission)
                                    <input type="checkbox" checked name="access[]" value="{{ $per->id }}"  /> <b>{{ $per->name }}</b> <br/>
                                    @else
                                        <input type="checkbox" name="access[]" value="{{ $per->id }}"  /> <b>{{ $per->name }}</b> <br/>
                                    @endif
                                    <?php $permissions2 =  DB::table('permissions')
                                    ->where('relate','=',$per->id)->get(); ?>
                                    @foreach($permissions2 as $p)
                                       <?php $user_subpermission= DB::table('permission_user')
                                    ->where('permission_id',"=",$p->id)
                                    ->where('user_id','=',$user->id)->first(); ?>
                                    @if($user_subpermission)
                                        ..........<input type="checkbox" checked name="access[]" value="{{ $p->id }}"> {{ $p->name }} <br/>
                                        @else
                                         ..........<input type="checkbox" name="access[]" value="{{ $p->id }}"> {{ $p->name }} <br/>
                                         @endif

                                        <?php $permissions3 =  DB::table('permissions')->where('relate','=',$p->id)->get(); ?>
                                        @foreach($permissions3 as $p3)

                                         <?php $user_subsubpermission= DB::table('permission_user')
                                    ->where('permission_id',"=",$p3->id)
                                    ->where('user_id','=',$user->id)->first(); ?>
                                    @if($user_subsubpermission)
                                            ....................<input type="checkbox" name="access[]" checked   value="{{ $p3->id }}"  /> {{ $p3->name }} <br/>
                                        @else 
                                             ....................<input type="checkbox" name="access[]"   value="{{ $p3->id }}"  /> {{ $p3->name }} <br/>
                                        @endif
                                        @endforeach
                                    @endforeach
                                @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- Department Specific Access -->
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-rounded" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info btn-rounded">Update</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->