<p id="demo" style="text-align: center;font-size: 60px;margin-top: 0px;"></p>

@section('script')
    <script>
        let testId ={!! $id !!};
        let testStartTime = {!! \App\Models\Tests::find($id) !!};
        console.log(testId);
        console.log(testStartTime['startTime']);
        // Set the date we're counting down to
        // axios.get('/api/getTestTime/' + testId).then(response => {
        //     console.log(response.data);
        //     let startTime = response.data;
        //     console.log(startTime);
        // }).catch(error => console.error(error));

        var countDownDate = new Date(testStartTime['startTime']).getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection



