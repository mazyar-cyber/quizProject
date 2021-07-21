@extends('admin.layouts.master')
@section('context')
    <div class="row">

        @if (\Illuminate\Support\Facades\Session::has('payment-successful'))
            <div class="alert alert-success">
                {!!session('payment-successful') !!}
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('payment-error'))
            <div class="alert alert-danger">
                {!!session('payment-error') !!}
            </div>
        @endif

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست طرح ها </h2>
                    <br><br>

                </div>

                <div class="box-body table-responsive no-padding">

                    <br>
                    @if(count($plans)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>نام طرح</th>
                                <th>قیمت طرح</th>
                                <th>توضیحات طرح</th>
                                <th>مدت زمان اعتبار(روز)</th>
                                <th></th>
                            </tr>

                            @foreach($plans as $plan)
                                <tr>
                                    <td>{{$plan->name}}</td>
                                    <td>{{number_format( $plan->price)}} تومان</td>
                                    <td><textarea style="width: 400px;resize: vertical" readonly>{{$plan->description}}</textarea></td>
                                    <td>{{$plan->validityTime}}</td>
                                    <form method="post" action="/order">
                                        @csrf
                                        <td>
                                            <input type="hidden" name="amount" value="{{$plan->price}}">
                                            <input type="hidden" name="planId" value="{{$plan->id}}">
                                            <input type="submit" class="btn btn-success" value="خرید">
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            موردی برای نمایش وجود ندارد
                        </div>
                    @endif

                </div>

                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
