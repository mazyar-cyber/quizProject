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
                    <h2 class="box-title">لیست طرح ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('plan-delete'))
                        <div class="alert alert-success">
                            {{session('plan-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('plan.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'plan.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($plans)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th>نام طرح</th>
                                <th>قیمت طرح</th>
                                <th>اعتبار طرح (روز)</th>
                                <th>توضیحات</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($plans as $plan)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$plan->id}}"></td>

                                    <td>{{$plan->name}}</td>
                                    <td>{{number_format( $plan->price)}} تومان</td>
                                    <td>{{$plan->validityTime}}</td>
                                    <td>{{$plan->description}}</td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($plan->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($plan->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="plan/{{$plan->id}}/edit"
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
