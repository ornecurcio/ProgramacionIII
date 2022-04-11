<!-- 
//======================================================================
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
//====================================================================== -->

<form action="action.php" method="post">
 <p>Codigo de Barra <input type="number" name="codigoBarra" /></p>
 <p>Nombre <input type="text" name="nombre" /></p>
 <p>Tipo <input type="text" name="tipo" /></p>
 <p>Stock <input type="number" name="stock" /></p>
 <p>Precio <input type="number" name="precio" /></p>
 <p><input type="submit" /></p>
</form>
<p>Recibe los datos del producto por POST:</p>
    <li>código de barra (6 cifras )</li>
    <li>nombre</li>
    <li>tipo</li>
    <li>stock</li>
    <li>precio</li>
<p>crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).</p>
<p>crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,</p>
<p>si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo renglón</p>
<p>Retorna un :</p>
<li>“Ingresado” si es un producto nuevo</li>
<li>“Actualizado” si ya existía y se actualiza el stock.</li>
<li>“no se pudo hacer“si no se pudo hacer</li>
<li>Hacer los métodos necesarios en la clase</li>