
            <h1>Mi carrito</h1>
            <hr>
            {{if mostrar}}

            <table>
                <thead>
                    <tr>
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
                {{foreach carretilla_auth}}
                <tr>
                
                <td>{{codigo}}</a></td>
                <td>{{nombre}}</td>
                <td>{{descripcion}}</td>
                <td>{{marca}}</td>
                <td>{{precio}}</td>
                <td>{{cantidad}}</td>
                <td>{{total}}</td>
                </tr>
                {{endfor carretilla_auth}}
            </tbody>
            
        </table>
        
        <form action="index.php?page=checkout_checkout" method="post">
            <button type="submit" name="btnConfirmar" class="btn primary">Pagar</button>
        </form>
        {{endif mostrar}}
         {{ifnot mostrar}}
        <h2>No ha realizado ninguna transacción</h2>
       
        {{endifnot mostrar}}