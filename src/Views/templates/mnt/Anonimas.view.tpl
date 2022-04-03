
            <h1>Mi carrito</h1>
            <hr>
        {{if mostrar}}
            <table>
                <thead>
                    <tr>
                    <!--<th>anoncartid</th>-->
                    <th>Codigo de celular</th>
                    <th>Celular</th>
                    <th>Descripcion</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    </tr>
            </thead>

            <tbody>
                {{foreach carretilla_anon}}
                <tr>
                    <!--<td>{{anoncartid}}</td>-->
                    <td>{{codigo}}</a></td>
                    <td>{{nombre}}</td>
                    <td>{{descripcion}}</td>
                    <td>{{marca}}</td>
                    <td>{{precio}}</td>
                    <td>{{cantidad}}</td>
                    <td>{{total}}</td>
                    </tr>
                {{endfor carretilla_anon}}
            </tbody>
            
        </table>
       
        <form action="index.php?page=mnt-Autenticados-Autenticados" method="post">
            <button type="submit" name="btnConfirmar" class="btn primary">Pagar</button>
        </form>
        {{endif mostrar}}
        {{ifnot mostrar}}
            <h2>No ha agregado ningún producto al carrito</h2>
        {{endifnot mostrar}}
    