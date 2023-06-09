console.clear();

function refDigit(arg) {
    return arg < 10 ? '0' + arg : '' + arg;
}

const hours = document.getElementById('hours');
const minutes = document.getElementById('minutes');
const seconds = document.getElementById('secunds');
const ampm = document.getElementById('ampm');
const cirf = document.querySelector('circle').getAttribute('cx') * 2 * 22 / 7;

const cHorurs = hours.parentNode.querySelector('circle:nth-child(2)');
const cMinutes = minutes.parentNode.querySelector('circle:nth-child(2)');
const cSeconds = seconds.parentNode.querySelector('circle:nth-child(2)');

const dotHours = hours.parentNode.querySelector('.dot');
const dotMinutes = minutes.parentNode.querySelector('.dot');
const dotSeconds = seconds.parentNode.querySelector('.dot');


function getTimeAndShow(){
    let h = new Date().getHours();
    let m = new Date().getMinutes();
    let s = new Date().getSeconds();
    let am = h <=12? 'AM' : 'PM';

    h = h <= 12? h : h -12;
    hours.innerHTML = refDigit(h) + "<br><span>Horas</span>"
    cHorurs.style.strokeDashoffset =cirf - (cirf / 12 * refDigit(h));
    dotHours.style.transform = `rotate(${360 * refDigit(h) / 12}deg)`;

    minutes.innerHTML = refDigit(m) + "<br><span>Minutos</span>"
    cMinutes.style.strokeDashoffset =cirf - (cirf / 60 * refDigit(m));
    dotMinutes.style.transform = `rotate(${360 * refDigit(m) / 60}deg)`;

    seconds.innerHTML = refDigit(s) + "<br><span>Segundos</span>"
    cSeconds.style.strokeDashoffset =cirf - (cirf / 60 * refDigit(s));
    dotSeconds.style.transform = `rotate(${360 * refDigit(s) / 60}deg)`;


    ampm.innerHTML = am;
}

setInterval(getTimeAndShow);