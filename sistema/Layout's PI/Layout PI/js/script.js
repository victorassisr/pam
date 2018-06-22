
/*var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
        datasets: [
            {
                data: [300, 50, 100, 40, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }
        ]
    },
    options: {
        responsive: true
    }    
});
var ctxP = document.getElementById("pieChart").getContext('2d');*/
var data = [
{
    value: 40,
    color:"#F7464A",
    highlight:"#FF5A5E",
    label:"red"
},
{
    value: 20,
    color:"#46BFBD",
    highlight:"#5AD3D1",
    label:"Green"
},
{
    value: 40,
    color:"#FDB45C",
    highlight:"#FFC870",
    label:"Yellow"
}
];

var ctx = document.getElementById("myChart").getContext("2d");
new Chart(ctx).Pie(data);