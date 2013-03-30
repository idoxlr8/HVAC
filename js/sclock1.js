function startclock()
{

var thetime=new Date();
var nhours=thetime.getHours();
var nmins=thetime.getMinutes();
var nsecn=thetime.getSeconds();
var AorP = (nhours >= 12) ? "P.M." : "A.M.";
if (nhours>=13)
  nhours-=12;
if (nhours<1)
 nhours=12;
if (nsecn<10)
 nsecn="0"+nsecn;
if (nmins<10)
 nmins="0"+nmins;
 
var clock_span = document.getElementById("my_clock");
clock_span.innerHTML = nhours+":"+nmins+":"+nsecn+" "+AorP;

setTimeout('startclock()',1000);
} 

if (document.getElementById && document.createTextNode) {
  startclock();
}
