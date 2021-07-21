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
                    <h2 class="box-title">لیست پی دی اف ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('pdf-delete'))
                        <div class="alert alert-success">
                            {{session('pdf-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('pdf.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>

                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'pdf.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($pdfs)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> عنوان</th>
                                <th> تماشای pdf</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($pdfs as $pdf)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$pdf->id}}"></td>

                                    <td>{!! $pdf->name !!}</td>
                                    <td><a href="/uploads/pdf/{{$pdf->path}}">here</a></td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($pdf->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($pdf->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="/admin/pdf/{{$pdf->id}}/edit"
                                           class="btn btn-instagram">ویرایش</a>
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
