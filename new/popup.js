var keepGoing = true;
var interval = 1000;
function execAjax() {
    $.ajax({
        type: 'GET',
        url: 'http://localhost/new/index.php' ,
        dataType: 'json' ,
        succes: function (data) {
            document.getElementById("yourVal").value=data;
        },
        error:{
            keepGoing=false,
        },
        complete: function(data) {
            if(keepGoing==true){
                setTimeout(execAjax,interval);
            }
        }
});
}
setTimeout(exectAjax,interval)
