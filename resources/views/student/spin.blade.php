@extends('admin.layouts.master')
@section('context')
    <div align="center">

        <div class="alert alert-info"><p>روی دکمه ی SPIN کلیک کنید تا چرخ گردون به حرکت درآید</p>
        </div>
        <br/>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <div class="power_controls">
                        <br/>
                        <br/>
                        <br/>
                        <img  width="100px" id="spin_button" src="/js/spin/spin_off.png" alt="Spin" title="بچرخ"
                             onClick="startSpin();"/>
                        <br/><br/>
                        &nbsp;&nbsp;<a href="#" title="دوباره" onClick="resetWheel(); return false;">Play Again</a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(reset)
                    </div>
                </td>
                <td width="438" height="582" class="the_wheel" align="center" valign="center">
                    <canvas id="canvas" width="434" height="434">
                        <p style="{color: white}" align="center">Sorry, your browser doesn't support canvas. Please try
                            another.</p>
                    </canvas>
                </td>
            </tr>
        </table>
    </div>

@endsection
@section('script')
    <script>
        // const axios = require('axios').default;
        // Create new wheel object specifying the parameters at creation time.
        let theWheel = new Winwheel({
            'numSegments': 8,     // Specify number of segments.
            'outerRadius': 212,   // Set outer radius so wheel fits inside the background.
            'textFontSize': 28,    // Set font size as desired.
            'segments':        // Define segments including colour and text.
                [
                    {'fillStyle': '#eae56f', 'text': '1'},
                    {'fillStyle': '#89f26e', 'text': '2'},
                    {'fillStyle': '#7de6ef', 'text': '3'},
                    {'fillStyle': '#e7706f', 'text': '4'},
                    {'fillStyle': '#eae56f', 'text': '5'},
                    {'fillStyle': '#89f26e', 'text': '6'},
                    {'fillStyle': '#7de6ef', 'text': '7'},
                    {'fillStyle': '#e7706f', 'text': '8'}
                ],
            'animation':           // Specify the animation to use.
                {
                    'type': 'spinToStop',
                    'duration': 15,
                    'spins': 8,
                    'callbackFinished': alertPrize,
                    'callbackSound': playSound,   // Function to call when the tick sound is to be triggered.
                    'soundTrigger': 'pin'        // Specify pins are to trigger the sound, the other option is 'segment'.
                },
            'pins':
                {
                    'number': 16   // Number of pins. They space evenly around the wheel.
                }
        });

        // -----------------------------------------------------------------
        // This function is called when the segment under the prize pointer changes
        // we can play a small tick sound here like you would expect on real prizewheels.
        // -----------------------------------------------------------------
        let audio = new Audio('tick.mp3');  // Create audio object and load tick.mp3 file.

        function playSound() {
            // Stop and rewind the sound if it already happens to be playing.
            audio.pause();
            audio.currentTime = 0;

            // Play the sound.
            audio.play();
        }

        // -------------------------------------------------------
        // Called when the spin animation has finished by the callback feature of the wheel because I specified callback in the parameters
        // note the indicated segment is passed in as a parmeter as 99% of the time you will want to know this to inform the user of their prize.
        // -------------------------------------------------------
        function alertPrize(indicatedSegment) {
            // Do basic alert of the segment text.
            // You would probably want to do something more interesting with this information.
            axios.get('/api/spin/' + indicatedSegment.text).then(response => {
                console.log(response);
                if (response.data == "timeError") {
                    toastr.error('امتیاز شما ثبت نشد چون در هر 24 ساعت یکبار امکان امتحان شانس وجود دارد!');
                }
            }).catch(error => console.log(error));
            alert("امتیاز شما:" + indicatedSegment.text);
            window.location.reload(false);
        }

        // =======================================================================================================================
        // Code below for the power controls etc which is entirely optional. You can spin the wheel simply by
        // calling theWheel.startAnimation();
        // =======================================================================================================================
        let wheelPower = 0;
        let wheelSpinning = false;

        // -------------------------------------------------------
        // Function to handle the onClick on the power buttons.
        // -------------------------------------------------------
        function powerSelected(powerLevel) {
            // Ensure that power can't be changed while wheel is spinning.
            if (wheelSpinning == false) {
                // Reset all to grey incase this is not the first time the user has selected the power.
                document.getElementById('pw1').className = "";
                document.getElementById('pw2').className = "";
                document.getElementById('pw3').className = "";

                // Now light up all cells below-and-including the one selected by changing the class.
                if (powerLevel >= 1) {
                    document.getElementById('pw1').className = "pw1";
                }

                if (powerLevel >= 2) {
                    document.getElementById('pw2').className = "pw2";
                }

                if (powerLevel >= 3) {
                    document.getElementById('pw3').className = "pw3";
                }

                // Set wheelPower var used when spin button is clicked.
                wheelPower = powerLevel;

                // Light up the spin button by changing it's source image and adding a clickable class to it.
                document.getElementById('spin_button').src = "spin_on.png";
                document.getElementById('spin_button').className = "clickable";
            }
        }

        // -------------------------------------------------------
        // Click handler for spin button.
        // -------------------------------------------------------
        function startSpin() {
            // Ensure that spinning can't be clicked again while already running.
            if (wheelSpinning == false) {
                // Based on the power level selected adjust the number of spins for the wheel, the more times is has
                // to rotate with the duration of the animation the quicker the wheel spins.
                if (wheelPower == 1) {
                    theWheel.animation.spins = 3;
                } else if (wheelPower == 2) {
                    theWheel.animation.spins = 8;
                } else if (wheelPower == 3) {
                    theWheel.animation.spins = 15;
                }

                // Disable the spin button so can't click again while wheel is spinning.
                document.getElementById('spin_button').src = "spin_off.png";
                document.getElementById('spin_button').className = "";

                // Begin the spin animation by calling startAnimation on the wheel object.
                theWheel.startAnimation();

                // Set to true so that power can't be changed and spin button re-enabled during
                // the current animation. The user will have to reset before spinning again.
                wheelSpinning = true;
            }
        }

        // -------------------------------------------------------
        // Function for reset button.
        // -------------------------------------------------------
        function resetWheel() {
            theWheel.stopAnimation(false);  // Stop the animation, false as param so does not call callback function.
            theWheel.rotationAngle = 0;     // Re-set the wheel angle to 0 degrees.
            theWheel.draw();                // Call draw to render changes to the wheel.

            document.getElementById('pw1').className = "";  // Remove all colours from the power level indicators.
            document.getElementById('pw2').className = "";
            document.getElementById('pw3').className = "";

            wheelSpinning = false;          // Reset to false to power buttons and spin can be clicked again.
        }
    </script>
@endsection
