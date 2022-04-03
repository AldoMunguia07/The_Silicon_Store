
            <h1>Detalle transacción</h1>
            <hr>

            <table>
                <thead>
                    <tr>
                        <th>Codigo celular</th>
                        <th>Celular</th>
                        <th>Descripción</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Observación</th>
                    </tr>
            </thead>

            <tbody>
                {{foreach miDetalle}}
                <tr>
                    <td>{{invPrdId}}</td>
                    <td>{{nombre}}</td>
                    <td>{{descripcion}}</td>
                    <td>{{marca}}</td>
                    <td>{{docPrc}}</td>
                    <td>{{docCtd}}</td>
                    <td>{{docDsc}}</td>
                    <td>{{Subtotal}}</td>  
                    <td>{{docLObs}}</td>                  
                    
                  

                    </tr>
                {{endfor miDetalle}}
            </tbody>
            
        </table>