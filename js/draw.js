$(document).ready(function () {
    showGraph();
});


function showGraph()
{
    {
        console.log("we here");

        $.post("../route/route.php?getQty=true",
        function (data)
        {
            console.log(data);
            var blod = JSON.parse(data);
           
            var name = [];
            var qty = [];

            for (var i in blod) {
              
                name.push(blod[i].blood);
                qty.push(blod[i].quantity);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'blood Inventory',
                        backgroundColor: '#e1261c',
                        borderColor: '#ef907c',
                        hoverBackgroundColor: '#ef907c',
                        hoverBorderColor: '#666666',
                        data: qty
                    }
                ]
            };

            var graphTarget = $("#graphCanvas");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
        });
    }
}