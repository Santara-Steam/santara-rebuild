var otp_expired = document.getElementById('otp_expired');
const code = document.getElementById('code');
const btnVerifikasiOtp = document.getElementById('btn-verifikasi-otp');

btnVerifikasiOtp.disabled = true;

$('#code').on('keyup blur input', function(e) {
    if (!is_empty(code.value) && code.value.length == 4) {
        btnVerifikasiOtp.disabled = false;
    } else {
        btnVerifikasiOtp.disabled = true;
    }
})

code.addEventListener('keydown', stopCarret);
code.addEventListener('keyup', stopCarret);

function stopCarret() {
    if (code.value.length > 3) {
        setCaretPosition(code, 3);
    }
}

function setCaretPosition(elem, caretPos) {
    if (elem != null) {
        if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        } else {
            if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            } else
                elem.focus();
        }
    }
}

function getTimeRemaining(endtime) {
    var t = dayjs(endtime) - dayjs(new Date());

    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock(id, endtime) {
    var clock = document.getElementById(id);
    //   var daysSpan = clock.querySelector('.days');
    //   var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');

    function updateClock() {
        endtime = endtime.replace(/-/g, '/');
        var t = getTimeRemaining(endtime);

        // daysSpan.innerHTML = t.days;
        // hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
            clearInterval(timeinterval);
            $("#btn-otp").removeAttr("disabled");
            $("#count-otp").remove();
            location.reload();
        }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
}

if (otp_expired) {
    initializeClock('clockdiv', otp_expired.value);
}