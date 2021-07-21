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

                    <div class="box-tools" id="app">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="جستجو"
                                   v-model="searchBox">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default" @click.prevent="getData()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('user-delete'))
                        <div class="alert alert-success">
                            {{session('user-delete')}}
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
                                <th>(نام کاربری)ایمیل</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$user->id}}"></td>

                                    <td>{!! $user->name !!}</td>
                                    <td>{{$user->email}}</td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($user->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($user->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="user/{{$user->id}}/edit"
                                           class="btn btn-instagram">ویرایش</a>
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
