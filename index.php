<!DOCTYPE html>
<html lang="en">

<head><!-- librerias a utilizar... -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>TRAVELLING SALESMAN PROBLEM</title>
</head>

<body><!-- Main -->
    <div class="container">
        <div class="row">
            <center>
                <h1>UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO</h1>
                <h2>ESCUELA PROFESIONAL DE INGENIERIA INFORMATICA Y DE SISTEMAS</h2>
            </center>
            <h3 class="pb-3 pt-5">Agregar Archivos</h3>

            <!-- Interfaz para gregar archivos CSV -->
            <div class="col-6 pb-3">
                <div class="mb-3">
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        
                            <label for="formFile" class="form-label">Ingresar matriz de distancias</label>
                            <input class="form-control mb-3" name="MatrizDeDistancias" type="file" id="formFile">
                            <input type="submit" class="btn btn-primary" value="Cargar Archivo">
                    </form>
                </div>
            </div>
        </div>
        

        <!--Operaciones y Creacion de tablas-->
        <div class="row">
            <div class="col-12 p-3">
                <div class="tab-content p-3">

                    <!--Operacion De Conversion de Lista de Matriculados de Este Semestre-->
                    <div class="tab-pane container" id="Matriz">
                        <table class="table">
                            <tbody>
                                <?php
                                    include 'CSVaArreglo.php';
                                    
                                    if (!isset($_FILES["MatrizDeDistancias"])) {
                                        throw new Exception("Selecciona un archivo CSV válido.");
                                    }
                                    $file     = $_FILES["MatrizDeDistancias"];
                                    $Instancia=new ClaseCSVaArray();
                                    $Array=$Instancia->CSV_a_Array($file);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--Parte donde se Muestran los resultados y se importan en archivos CSV los resultados-->
            <div class="col-12 text p-2">
                <h3 class="pb-3">Resultados</h3>
                <div class="tab-content p-2"><!--Lista de Operaciones a ahcer-->
                    <div class="tab-pane container active" id="Operaciones">
                        <table class="table"><!--Esta Tabla no se muestra, en nuestra interfaz de resultado, pero si utilizamos el resultado que se obtiene en el balanceo-->
                            <tbody>
                            <?php
                                include 'TSP-ProgramacionDinamica.php';
                                include 'TSP-FuerzaBruta.php';
                                $InstanciaI=new ClaseCSVaArray();
                                $Instancia2=new TSP_Dynamic_Programming();
                                $Instancia3=new TSP_FuerzaBruta();
                                //$InstanciaI->ImprimirArray($Array);
                                $start = microtime(true);
                                $Instancia3->CalcularPorFuerzaBruta($Array);
                                $end = microtime(true);
                                $time = $end-$start;
                                $time = number_format($time, 5);
                                echo '<br>'.'Tiempo de Ejecucion: '.$time.' Segundos';
                                echo '<br><br>';
                                //Obtener ruta y medir tiempo
                                $start = microtime(true);
                                $Instancia2->CalcularPorProgramacionDinamica($Array);
                                $end = microtime(true);
                                $time = $end-$start;
                                $time = number_format($time, 5);
                                echo '<br>'.'Tiempo de Ejecucion: '.$time.' Segundos';
                                
                                

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>