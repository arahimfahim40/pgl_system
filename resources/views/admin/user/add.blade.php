<div class="modal fade" id="add_user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">User Register Form</h4>
            </div>
            <form action="{{url('add_user_admin')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="email">Username *</label>
                    <input type="text" name="username" id="email" class="form-control" placeholder="enter user name" />
                </div>
                    <div class="form-group">
                        <label for="email">User Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter user email" />
                    </div>
                <div class="form-group">
                    <label for="password">User Password *</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="enter user password" />
                </div>
                <div class="form-group">

                    <label for="usert">Choose User Privileges *</label>
                    <select name="usert" id="user-type"  class="form-control" id="">
                        <?php $user_type=DB::table('user_types')->get(); ?>
                        @foreach($user_type as $type_user)
                            <option value="{{$type_user->id}}">{{$type_user->type}}</option>
                        @endforeach
                    </select>
                    <!-- Restricted User Access -->
                    <div id="access" class="panel panel-primary hidden">
                        <div class="panel-heading">
                            Choose Access Pages
                        </div>
                        <div class="panel-body">
                            <?php $permissions = DB::table('permissions')->where('relate','=','0')->get(); ?>
                            @foreach($permissions as $per)
                                @if($per->main == 1)
                                    <?php continue; ?>
                                @endif
                                <input type="checkbox" name="access[]" value="{{ $per->id }}" /> <b>{{ $per->name }}</b> <br/>
                                <?php $permissions2 =  DB::table('permissions')->where('relate','=',$per->id)->get(); ?>
                                @foreach($permissions2 as $p)
                                    ..........<input type="checkbox" name="access[]" value="{{ $p->id }}" /> {{ $p->name }} <br/>
                                    <?php $permissions3 =  DB::table('permissions')->where('relate','=',$p->id)->get(); ?>
                                    @foreach($permissions3 as $p3)
                                        ....................<input type="checkbox" name="access[]" value="{{ $p3->id }}" /> {{ $p3->name }} <br/>

                                    @endforeach

                                @endforeach

                            @endforeach

                        </div>

                    </div>

                    <!-- Department Specific Access -->
                </div>
                <div class="form-group">
                    <label for="file">Choose Photo *</label><br>
                    <input type="file" name="photo" id="file" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-rounded" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info btn-rounded">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->