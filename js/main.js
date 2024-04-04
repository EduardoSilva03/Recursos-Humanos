function consultaCep() {
    var cep = document.getElementById("cep").value;
    var url = "https://viacep.com.br/ws/" + cep + "/json/";
    console.log(cep);
    $.ajax({
        url: url, 
        type: "GET",
        success: function(response) {
            console.log(response);
            $("#municipio").attr("value", response.localidade);
            $("#uf").attr("value", response.uf);
            $("#logradouro").attr("value", response.logradouro);
            $("#bairro").attr("value", response.bairro);
        }
    })
}