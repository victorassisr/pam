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