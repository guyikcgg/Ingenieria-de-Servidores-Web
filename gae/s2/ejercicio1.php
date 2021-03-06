<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Me tropecé con la alcachofa: Arroz con leche</title>
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <h1 id="recipe"><a href="#recipe">Arroz con leche</a></h1>

    <img src="/img/1.jpg" alt="Foto de la presentación final del plato">

    <p>
      El <strong>arroz con leche</strong> es un postre tradicional andaluz. Sin embargo, sus orígenes son muy antiguos, surgiendo de forma paralela en otros territorios lejanos.
      <br>
      Así por ejemplo, en Alemania tenemos el <q lang="de">Milchreis</q>, que se sirve con mermelada, y en Francia existe una versión muy parecida del arroz con leche andaluz, el <q lang="fr">riz au lait</q>.
    </p>

    <h2 id="ingredients"><a href="#directions">Ingredientes</a></h2>
    <p>Para preparar este delicioso postre necesitarás:</p>
    <ul>
      <li>1 litro de leche de vaca (entera o semidesnatada)</li>
      <li>1/2 vaso de arroz redondo</li>
      <li>Un trozo de canela en rama</li>
      <li>La cáscara de medio limón</li>
      <li>7 cucharadas soperas rasas de azúcar</li>
      <li>Un poco de canela molida</li>
    </ul>

	<?php
	echo "hola";

	for ($i=0; $i<3; ++$i)
	echo '
    <table summary="Tiempos de preparación">
      <caption>
        Tiempos
      </caption>
      <tr>
        <th>Tiempo estimado de preparación</th>
        <td>10 minutos</td>
      </tr>
      <tr>
        <th>Tiempo estimado de cocción</th>
        <td>20 minutos</td>
      </tr>
      <tr>
        <th>Tiempo total</th>
        <td>30 minutos</td>
      </tr>
    </table>
	';
	?>

    <h2 id="directions"><a href="#more-recipes">Preparación</a></h2>
    <p>
      Poner la leche, la cáscara de limón y la canela en rama en una olla. Calentar a fuego medio-rápido.
      Antes de que la leche empiece a hervir añadir el arroz.
      Remover durante 20 minutos aproximadamente.
    </p>
    <p>
      Cuando el arroz empiece a estar tierno, añadir el azúcar y remover durante otros 5 minutos más.
      El arroz debe estar tierno, pero consistente, y aún debe quedar mucha leche con una textura bastante líquida.
    </p>
    <p>
      Llegados a este punto, apagar el fuego y repartir la mezcla en cuencos.
      Poner un poco de canela molida en cada cuenco. Una vez enfriado, estará listo para comer.
    </p>

    <ol>
      <li>
        <cite><a href="https://es.wikipedia.org/wiki/Arroz_con_leche">Arroz con leche - Wikipedia, la enciclopedia libre</a></cite>
      </li>
      <li>
        <cite><a href="http://www.milchreisrezept.de/daenischer-milchreis/">Dänischer Milchreis – Risalamande</a></cite>
      </li>
    </ol>

    <p id="more-recipes">
      Podrás encontrar más recetas en <cite><a href="https://github.com/guyikcgg/me-tropece-con-la-alcachofa">Me tropecé con la alcachofa</a></cite>.
    </p>
  </body>
</html>
