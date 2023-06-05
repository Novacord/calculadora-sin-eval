<?php
function calcular($operacion){
    $operacion = str_replace(' ','',$operacion);
    $coincidencias = preg_split('/([+\-*\/])/', $operacion, -1, PREG_SPLIT_DELIM_CAPTURE);
    
    $numeros = array_map(function($val){
        return is_numeric($val) ? floatval($val) : $val;
    }, array_slice($coincidencias, 0));

    foreach($numeros as $key => $valor){
        if($valor == '*'){
            $numero1 = $numeros[key-1];
            $numero2 = $numeros[key+2];
            $resultado = $numero1 * $numero2;
        }
    }

    return $resultado;
}

session_start();

if (isset($_POST['numero'])) {
    if ($_POST['numero'] == "c") {
        $_SESSION['num1'] = null;
    } elseif ($_POST['numero'] == "←") {
        $_SESSION['num1'] = substr($_SESSION['num1'], 0, strlen($_SESSION['num1']) - 1);
    } elseif ($_POST['numero'] == "=") {
        // $_SESSION['num1'] = );
        var_dump(calcular($_SESSION['num1']));
    } else {
        if (isset($_SESSION['num1'])) {
            $_SESSION['num1'] .= $_POST['numero'];
        } else {
            $_SESSION['num1'] = $_POST['numero'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calculadora sin eval</title>
        <style>
        form {


width: 100%;

max-width: 400px;

text-align: center;

border: solid 1px #c2c2c2;

padding-bottom: 10px;

padding-top: 10px;

margin: auto;

margin-top: 300px;

background: #fafafa;

}

input[type=text] {

  width: 75%;

  padding: 20px 32px;

  font-size: 16px;

  margin: 8px 0;

  border: 1px solid silver;

  border-radius: 50px;

  text-align: left;

  color: #333;

  outline: none;

  background: rgb(159, 243, 243);

}

input[type=button], input[type=submit], input[type=reset] {

  background-color: rgb(159, 243, 243);

  border: none;

  color: black;

  border-radius: 50px;

  padding: 16px 32px;

  font-size: 16px;

  min-width: 21%;

  text-decoration: none;

  margin: 4px 2px;

  cursor: pointer;

}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover {

background-color: rgb(15, 90, 112);

}
    </style>
</head>
<body>
    <form method="POST">
        <input type="text" name="resultado" value="<?php echo isset($_SESSION['num1']) ? $_SESSION['num1'] :0;?>">
        <br>
        <input type="submit" name="numero" value="1">
        <input type="submit" name="numero" value="2">
        <input type="submit" name="numero" value="3">
        <input type="submit" name="numero" value="+">
        <br>
        <input type="submit" name="numero" value="4">
        <input type="submit" name="numero" value="5">
        <input type="submit" name="numero" value="6">
        <input type="submit" name="numero" value="-">
        <br>
        <input type="submit" name="numero" value="7">
        <input type="submit" name="numero" value="8">
        <input type="submit" name="numero" value="9">
        <input type="submit" name="numero" value="*">
        <br>
        <input type="submit" name="numero" value="0">
        <input type="submit" name="numero" value="c">
        <input type="submit" name="numero" value="/">
        <input type="submit" name="numero" value="=">
        <input type="submit" name="numero" value="←">
    </form>
</body>
</html>