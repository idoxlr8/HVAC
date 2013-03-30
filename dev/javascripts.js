function formHandler(form){
var URL = document.form.site.options[document.form.site.selectedIndex].value;
window.location.href = URL;
}

function openNewWindow(fileName,windowName,theWidth,theHeight)
{
      window.open(fileName,windowName,"toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width="+theWidth+",height="+theHeight)
} 

function popup(Site)
{
window.open(Site,'PopupName','toolbar=no,statusbar=no,
location=no,scrollbars=yes,resizable=yes,width=275,height=200')
}

function Exchange(First, Second){
var Elm1 = document.getElementById(First);
var Elm2 = document.getElementById(Second);
Elm2.value = Elm1.value;
}

function updatesum() {
document.new_invoice_record_form.total.value = (document.new_invoice_record_form.tax.value -0) + (document.new_invoice_record_form.labortotal.value -0);
}

