@extends('admin.layouts.master')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#option3").click(function () {
                if (this.checked) {
                    $(".checkBox").each(function () {
                        this.checked = true
                    })
                } else {
                    $(".checkBox").each(function () {
                        this.checked = false
                    })
                }
            })
        })
    </script>
@endsection
@section('context')

    <div class="row">

        <div class="col-xs-12">


            <div class="box">

                <div class="box-header">
                    <h2 class="box-title">کاربران</h2>

                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('user-delete'))
                        <div class="alert alert-success">
                            {{session('user-delete')}}
                        </div>
                    @endif

                    @if (\Illuminate\Support\Facades\Session::has('cant-delete'))
                        <div class="alert alert-danger">
                            {{session('cant-delete')}}
                        </div>
                    @endif

                    @if (\Illuminate\Support\Facades\Session::has('user-not-delete'))
                        <div class="alert alert-danger">
                            {{session('user-not-delete')}}
                        </div>
                    @endif

                    <a class="btn btn-app pull-left" href="{{route('user.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'user.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($users)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> نام</th>
                                <th>(نام کاربری)تلفن</th>
                                <th>سطح دسترسی</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$user->id}}"></td>

                                    <td>{!! $user->name !!}</td>
                                    <td>{{$user->phoneNumber}}</td>
                                    <td>
                                        @if($user->is_teacher==0)
                                            <span class="bg bg-yellow">کاربر عادی</span>
                                        @else
                                            <span class="bg bg-info">ادمین</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($user->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($user->updated_at) }}
                                    </td>

                                    <td>
                                        @if($user->email!=\Illuminate\Support\Facades\Auth::user()->email)
                                            <a href="user/{{$user->id}}/edit"
                                               class="btn btn-instagram">ویرایش</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            موردی برای نمایش وجود ندارد
                        </div>
                    @endif
                    {!! Form::close() !!}
                </div>

                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                searchBox: [],
                data: [],
            },
            methods: {
                getData() {
                    axios.get(`/api/getSearchedResultUsers/${this.searchBox}`)
                        .then(response => {
                            console.log(response.data);
                            this.data = response.data;
                        })
                        .catch(error => console.error(error))
                }
            }
        });
    </script>
@endsection
