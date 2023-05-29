<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <link rel="shortcut icon" href="../sources/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital@1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<style>
  /* Pagina error 404 */

  .no-decoration {
        color: black;
        text-decoration: none;
    }

    .error {
        color: black
    }


    .error-container {
    text-align: center;
    font-size: 180px;
    font-family: 'Catamaran', sans-serif;
    font-weight: 800;
    margin: 20px 15px;
    }
    .error-container > span {
    display: inline-block;
    line-height: 0.7;
    position: relative;
    color: #FFB485;
    }
    .error-container > span > span {
    display: inline-block;
    position: relative;
    }
    .error-container > span:nth-of-type(1) {
    perspective: 1000px;
    perspective-origin: 500% 50%;
    color: #F0E395;
    }
    .error-container > span:nth-of-type(1) > span {
    transform-origin: 50% 100% 0px;
    transform: rotateX(0);
    animation: easyoutelastic 8s infinite;
    }

    .error-container > span:nth-of-type(3) {
    perspective: none;
    perspective-origin: 50% 50%;
    color: #D15C95;
    }
    .error-container > span:nth-of-type(3) > span {
    transform-origin: 100% 100% 0px;
    transform: rotate(0deg);
    animation: rotatedrop 8s infinite;
    }
    @keyframes easyoutelastic {
    0% {
        transform: rotateX(0);
    }
    9% {
        transform: rotateX(210deg);
    }
    13% {
        transform: rotateX(150deg);
    }
    16% {
        transform: rotateX(200deg);
    }
    18% {
        transform: rotateX(170deg);
    }
    20% {
        transform: rotateX(180deg);
    }
    60% {
        transform: rotateX(180deg);
    }
    80% {
        transform: rotateX(0);
    }
    100% {
        transform: rotateX(0);
    }
    }

    @keyframes rotatedrop {
    0% {
        transform: rotate(0);
    }
    10% {
        transform: rotate(30deg);
    }
    15% {
        transform: rotate(90deg);
    }
    70% {
        transform: rotate(90deg);
    }
    80% {
        transform: rotate(0);
    }
    100% {
        transform: rotateX(0);
    }
    }
        
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .error {
    background-color: #ffffff;
    margin-bottom: 50px;
    }
    html, button, input, select, textarea {
        font-family: 'Montserrat', Helvetica, sans-serif;
        color: #ffffff;
    }
    h1 {text-align: center;
        margin: 30px 15px;
    }
    .zoom-area { 
        max-width: 490px;
        margin: 30px auto 30px;
        font-size: 19px;
        text-align: center;
    }
    a.more-link {
        text-transform: uppercase;
        font-size: 13px;
        background-color: #ffffff;
        padding: 10px 15px;
        border-radius: 0;
        color: #fff;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
        line-height: 1.5;
        text-decoration: none;
        margin-top: 50px;
        letter-spacing: 1px;
    }
</style>

<body class="error">
  <h1>404 Error Page</h1>
  <p class="zoom-area"></b>Pagina no encontrada</p>
  <section class="error-container">
    <span><span>4</span></span>
    <span>0</span>
    <span><span>4</span></span>
  </section>
</body>
</html>