@extends('admin.layouts.master')
@section('context')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست تراکنش ها </h2>
                    <br><br>
                </div>
                <div class="box-body table-responsive no-padding">
                    <br>
                    @if(count($orders)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>نام کاربر</th>
                                <th>نام طرح</th>
                                <th>وضعیت سفارش</th>
                                <th> تاریخ اقدام برای خرید</th>
                            </tr>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->plan->name}}</td>
                                    <td>
                                        @if($order->order->status=="1")
                                            <span style="color: #00e765">موفق</span>
                                        @else
                                            <span style="color: darkred">ناموفق</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Facades\Verta::instance($order->created_at)->formatDifference()}}
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
                </div>
            </div>
        </div>
    </div>
@endsection
