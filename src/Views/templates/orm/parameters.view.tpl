<h1>Generador de CRUD 1.0</h1>
<hr>
<form action="index.php?page=orm.parameters" method="post">
    <label for="table">
        <input type="table" name="table" value="{{table}}" placeholder="table" type="text">
    </label>
     <label for="namespace">
        <input type="namespace" name="namespace" value="{{namespace}}" placeholder="namespace/entity" type="text">
    </label>
    <!--<label for="entity">
        <input type="entity" name="entity" value="{{entity}}" placeholder="entity" type="text">
    </label>-->
    <button type="submit">Generar</button>

</form>

<h2>Controlador formulario</h2>
<pre>
    {{formCode}}
</pre>
<hr>
<h2>Controlador lista de datos</h2>
<pre>
    {{listController}}
</pre>
<hr>
<h2>Codigo del DAO</h2>
<pre>
    {{daoCode}}
</pre>
<hr>

<h2>Vista de lista de datos</h2>
<pre>
    {{vistaListar}}
</pre>
<hr>
<h2>Vista del formulario</h2>
<pre>
    {{vistaFormulario}}
</pre>
<hr>
<h2>URL</h2>
<pre>
    {{url}}
</pre>