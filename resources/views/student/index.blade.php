@extends('admin.layouts.master')
@section('context')
    @if (\Illuminate\Support\Facades\Session::has('result-save'))
        <div class="alert alert-success">
            {{session('result-save')}}
        </div>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('result-forbidden'))
        <div class="alert alert-warning">
            {{session('result-forbidden')}}
        </div>
    @endif
    @if($errors->all())
        <div class="alert alert-danger">
            به همگی سوالات بایست جواب دهید
        </div>
    @endif
    <form action="{{route('result.store')}}" method="post">
        @csrf
        @foreach($questions as $q)
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$q->question}} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>1.</td>
                                <td><textarea readonly style="resize: vertical;width: 400px">{{$q->answer1}}</textarea>
                                </td>
                                <td>
                                    <input type="radio" name="answers[answerOf,{{$q->id}}]" value="1"
                                           style="width: 30px;height: 30px;background: white;border-radius: 5px;border: 2px solid #555;">
                                </td>

                            </tr>
                            <tr>
                                <td>2.</td>
                                <td><textarea readonly style="resize: vertical;width: 400px">{{$q->answer2}}</textarea>
                                </td>
                                <td>
                                    <input type="radio" name="answers[answerOf,{{$q->id}}]" value="2"
                                           style="width: 30px;height: 30px;background: white;border-radius: 5px;border: 2px solid #555;">
                                </td>

                            </tr>
                            <tr>
                                <td>3.</td>
                                <td><textarea readonly style="resize: vertical;width: 400px">{{$q->answer3}}</textarea>
                                </td>
                                <td>
                                    <input type="radio" name="answers[answerOf,{{$q->id}}]" value="3"
                                           style="width: 30px;height: 30px;background: white;border-radius: 5px;border: 2px solid #555;">
                                </td>

                            </tr>

                            <tr>
                                <td>3.</td>
                                <td><textarea readonly style="resize: vertical;width: 400px">{{$q->answer4}}</textarea>
                                </td>
                                <td>
                                    <input type="radio" name="answers[answerOf,{{$q->id}}]" value="4"
                                           style="width: 30px;height: 30px;background: white;border-radius: 5px;border: 2px solid #555;"
                                           class="mycheckbox">
                                </td>

                            </tr>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endforeach
        <center>
            <input type="submit" class="btn btn-warning" value="اتمام آزمون">
        </center>
    </form>
@endsection
