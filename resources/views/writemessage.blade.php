<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</head>
<script>
    var myLineChart;
    var socket = io.connect('http://localhost:8890', {
        query: 'token=AS566-123N77-123NSY-NSB28ya7'
    });

    socket.on('onlineUsers', function (data) {
        console.log("Usuarios conectados :: ", data);
        config.data.datasets[0].data[0] = data;
        if(myLineChart !== undefined)
            myLineChart.update();
    });

    $(document).on('click','#btnSendMessage',function (){
        var url = '{{ URL::to('/sendmessage') }}';
        $.post( url ,{ message: $("#txtMessage").val() } );
        $("#txtMessage").val("");
    });
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: [0,1,1,1],
                backgroundColor: ["#2ecc71","#9b59b6","#e67e22","#1abc9c" ],
                label: 'Dataset 1'
            }],
            labels: [ "Guestbook", "Qbits Android", "Qbits IOS", "Comida Rapida" ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        myLineChart = new Chart(ctx,{
            type: 'pie',
            data: config.data
        });
    };
</script>
<body>


<input type="text" id="txtMessage"/>
<button id="btnSendMessage">Enviar</button>

<div id="canvas-holder" style="width:100%">
    <canvas id="chart-area" />
</div>

</body>
</html>