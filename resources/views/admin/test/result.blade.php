@extends('admin.layouts.master')
@section('context')

   <div class="alert alert-warning">
       توجه:
       آزمون هایی که به پایان نرسیده باشند،نتایج آنها به روز نیستند(ممکن است کاربر در حال پاسخگویی به آنها باشد)
   </div>
    <div id="app">
        <show-result></show-result>
    </div>
@endsection
