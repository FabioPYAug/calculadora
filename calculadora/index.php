<!DOCTYPE html>
<html>
<script>
    let valor1 = " ";
    let tipo;
    let valor2 = " ";
</script>
<style>
    .button {
        border: none;
        color: rgb(230, 230, 230);
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .button1 {
        background-color: darkslategrey;
    }
</style>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php include "./style.php"; ?>
</head>

<body>
    <h1 class="titulocal">Calculadora</h1>
    <div class="titulo"></div>
    <title>Calculadora</title>
    <div class="calculator">
        <p class="input" id="demo"></p>
        <div class="buttons">
            <div class="operators">
                <button value="+" onClick=elemento(this.value) class="button button1">+</button>
                <button value="-" onClick=elemento(this.value) class="button button1">-</button>
                <button value="x" onClick=elemento(this.value) class="button button1">x</button>
                <button value="÷" onClick=elemento(this.value) class="button button1">÷</button>
            </div>
            <div class="valores">
                <div class="numeros">
                    <button value=7 onClick=conta(this.value) class="button button1">7</button>
                    <button value=8 onClick=conta(this.value) class="button button1">8</button>
                    <button value=9 onClick=conta(this.value) class="button button1">9</button>
                </div>
                <div class="numeros">
                    <button value=4 onClick=conta(this.value) class="button button1">4</button>
                    <button value=5 onClick=conta(this.value) class="button button1">5</button>
                    <button value=6 onClick=conta(this.value) class="button button1">6</button>
                </div>
                <button value=1 onClick=conta(this.value) class="button button1">1</button>
                <button value=2 onClick=conta(this.value) class="button button1">2</button>
                <button value=3 onClick=conta(this.value) class="button button1">3</button>
                <div class="outros">
                    <button value=0 onClick=conta(this.value) class="button button1">0</button>
                    <button onClick=limpar() class="button button1">Limpar</button>
                    <button onClick=resultado() class="button button1">=</button>
                </div>
                <div class="dados">
                    <button value="apagar" onClick=Apagar(this.value) class="button button1">Apagar Histórico</button>
                    <button value="ler" id="lerhist" onClick=Ler(this.value) class="button button1">Fechar Histórico</button>

                </div>
            </div>
        </div>
    </div>
    <div id=quadrado>
        <p class="historico" id="his"></p>
    </div>

    <script>
        function conta(valor) {
            if (tipo == "+" || tipo == "-" || tipo == "x" || tipo == "÷") {
                valor2 = valor2 + `${valor}`
                document.getElementById("demo").innerHTML = valor2;
                valor2 = Number(valor2)
            } else {
                valor1 = valor1 + `${valor}`
                document.getElementById("demo").innerHTML = valor1;
                valor1 = Number(valor1)
            }
        }

        function elemento(valor) {
            document.getElementById("demo").innerHTML = valor;

            tipo = valor
        }

        function Ler() {
            var quadrado = document.getElementById("quadrado");
            if (quadrado.style.display === "none") {
                quadrado.style.display = "flex";
            } else {
                quadrado.style.display = "none";
            }
            if(document.getElementById("lerhist").innerHTML == "Ler Histórico"){
                document.getElementById("lerhist").innerHTML = "Fechar Histórico" 
            }else{document.getElementById("lerhist").innerHTML = "Ler Histórico" }
            
            $.ajax({
                url: "./function.php",
                type: "post",
                async: true,
                data: {
                    acao: "lerHistorico"
                },
                dataType: "json",
                success: function(result) {
                    document.getElementById("his").innerHTML = result.historico + "\n\n";
                    console.log(result.historico)
                },
                error: function(data) {
                    console.log(data);
                    alert('error handling here');
                }
            });
        }

        function Apagar() {
            $.ajax({
                url: "./function.php",
                type: "post",
                async: true,
                data: {
                    acao: "apagarHistorico"
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                },
                error: function(data) {
                    console.log(data);
                    alert('error handling here');
                }
            });
        }

        function resultado() {
            let valortotal;
            switch (tipo) {
                case "+":
                    valortotal = valor1 + valor2
                    document.getElementById("demo").innerHTML = valortotal;
                    break;
                case "-":
                    valortotal = valor1 - valor2
                    document.getElementById("demo").innerHTML = valortotal;
                    break;
                case "x":
                    valortotal = valor2 * valor1
                    document.getElementById("demo").innerHTML = valortotal;
                    break;
                case "÷":
                    valortotal = valor1 / valor2
                    document.getElementById("demo").innerHTML = valortotal;
                    break;
            }

            $.ajax({
                url: "./function.php",
                type: "post",
                async: true,
                data: {
                    acao: "gravarResultado",
                    filtros: {
                        conta: valor1 + " " + tipo + " " + valor2,
                        resultado: valortotal
                    }
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                },
                error: function(data) {
                    console.log(data);
                    alert('error handling here');
                }
            });
        }

        function limpar() {
            valor2 = " "
            valor1 = " "
            tipo = " "
            document.getElementById("demo").innerHTML = valor1;
        }
    </script>
</body>

</html>