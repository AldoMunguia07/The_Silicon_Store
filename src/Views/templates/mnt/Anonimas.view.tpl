
            <h1>Mi carrito</h1>
            <hr>

            <table>
                <thead>
                    <tr>
                    <!--<th>anoncartid</th>-->
                    <th>Codigo de producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Expiración</th>
                    </tr>
            </thead>

            <tbody>
                {{foreach carretilla_anon}}
                <tr>
                    <!--<td>{{anoncartid}}</td>-->
                    <td>{{invPrdId}}</a></td>
                    <td>{{cartCtd}}</td>
                    <td>{{cartPrc}}</td>
                    <td>{{cartIat}}</td>
                    </tr>
                {{endfor carretilla_anon}}
            </tbody>
            
        </table>