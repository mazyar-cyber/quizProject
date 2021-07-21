@extends('admin.layouts.master')
@section('script')
    <script>
        tinymce.init({
            selector: '#myEditTextArea',
        });
    </script>
@endsection
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش سوال <span
                        style="font-weight: bolder">{!! \Illuminate\Support\Str::limit($question->question, 200, '...') !!}</span>
                </h3>
                <img src="{{asset("uploads/photos/question/$question->photo_path")}} " alt="سوال عکس ندارد"
                     width="400px">
                @if (\Illuminate\Support\Facades\Session::has('question-time-error'))
                    <div class="alert alert-warning">
                        {{session('question-time-error')}}
                    </div>
                @endif
                @if (\Illuminate\Support\Facades\Session::has('question-edit'))
                    <div class="alert alert-success">
                        {{session('question-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        سوال شما ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('question.index')}}">
                    <i class="fa fa-list"></i> لیست سوال ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('question.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('question.update',$question->id)}}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>نام آزمون را میتوانید تغییر دهید</label>
                    <select class="form-control select2" name="test" style="width: 100%;" required>
                        @foreach($tests as $test)
                            <option value="{{$test->id}}"
                                    @if($test->id==$question->test->id) selected @endif>{{$test->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label>درس سوال را میتوانید تغییر دهید</label>
                    <select class="form-control select2" name="lesson" style="width: 100%;" required>
                        @foreach($lessons as $lesson)
                            <option value="{{$lesson->id}}"
                                    @if($question->lesson_id==$lesson->id) selected @endif>{{$lesson->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">صورت سوال</label>
                        <textarea name="question" class="form-control"
                                  id="myEditTextArea">{{$question->question}}</textarea>
                        @error('question')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب اول</label>
                        <textarea name="answer1" class="form-control">{{$question->answer1}}</textarea>
                        @error('answer1')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> جواب دوم </label>
                        <textarea name="answer2" class="form-control">{{$question->answer2}}</textarea>
                        @error('answer2')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب سوم</label>
                        <textarea name="answer3" class="form-control">{{$question->answer3}}</textarea>
                        @error('answer3')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب چهارم</label>
                        <textarea name="answer4" class="form-control">{{$question->answer4}}</textarea>
                        @error('answer4')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">ویرایش عکس سوال</label>
                        <input type="file" name="pic" id="exampleInputFile">
                        @error('pic')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>جواب صحیح</label>
                            <select class="form-control select2" name="trueAnswer" style="width: 100%;" required>
                                <option value="1" @if($question->trueAnswer==1) selected @endif >جواب اول</option>
                                <option value="2" @if($question->trueAnswer==2) selected @endif>جواب دوم</option>
                                <option value="3" @if($question->trueAnswer==3) selected @endif>جواب سوم</option>
                                <option value="4" @if($question->trueAnswer==4) selected @endif>جواب چهارم</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>مدت زمان پاسخگویی به این سوال(به دقیقه)(این قسمت هنوز اعمال نشده )</label>
                        <input class="form-group" type="number" name="TimeToAnswer" value="{{$question->TimeToAnswer}}">
                        @error('TimeToAnswer')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"> نمره یا امتیاز سوال را تعیین کنید</label>
                            <select class="form-control select2" name="questionStar" style="width: 100%;" required>
                                @for($i=1;$i<=100;$i++)
                                    <option value='{{$i}}'
                                            @if($question->QuestionStar==$i) selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
