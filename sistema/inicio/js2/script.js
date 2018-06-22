
window.onload = function(){
    $.get("grafico.php",function(data, status){
        var valores = [
        {
            value: 40,
            color:"#F7464A",
            highlight:"#FF5A5E",
            label:"Doacoes do Mês"
        },
        {
            value: 20,
            color:"#46BFBD",
            highlight:"#5AD3D1",
            label:"Despesas"
        }
        ];
    });
}

var ctx = document.getElementById("myChart").getContext("2d");



new Chart(ctx).Pie(valores);