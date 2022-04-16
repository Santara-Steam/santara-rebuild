const login_session = document.getElementById('login_session');

// autologout
if (login_session && login_session.innerHTML == 1) {
    // idle timeout
    $(function() {
        $("body").on('click keypress', function() {
            ResetThisSession();
        });
    });

    var timePerCheck = 10; // check in second
    var timeInSecondsAfterSessionOut = 1800; // change this to change session time out (in seconds).
    var time = timeInSecondsAfterSessionOut / timePerCheck;
    var secondTick = 0;

    function ResetThisSession() {
        secondTick = 0;
    }

    function StartThisSessionTimer() {
        secondTick++;
        if (secondTick == time) {
            clearTimeout(tick);
            window.location = "/login/logout";
        }
        tick = setTimeout("StartThisSessionTimer()", timePerCheck * 1000);
    };
    StartThisSessionTimer();
}

// console.log('start typing...');
console.clear();
console.log(`
     ******       ******
  **********   ***********
 ************* *************
*****************************
*****************************
*****************************
 ***************************
  ************************
     *******************
      ****************
         ***********
          ********
             ****
              **`);