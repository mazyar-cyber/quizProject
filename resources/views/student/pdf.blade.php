@extends('admin.layouts.master')
@section('context')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست پی دی اف ها </h2>
                    <br><br>

                </div>

                <div class="box-body table-responsive no-padding">

                    <br>
                    @if(count($pdfs)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>

                                <th> عنوان</th>
                                <th> تماشای pdf</th>
                                <th> تاریخ ایجاد</th>
                            </tr>

                            @foreach($pdfs as $pdf)
                                <tr>
                                    <td>{!! $pdf->name !!}</td>
                                    <td><a href="/uploads/pdf/{{$pdf->path}}">here</a></td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($pdf->created_at) }}
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            فایلی برای نمایش وجود ندارد
                        </div>
                @endif


                <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
        </div>

@endsection
