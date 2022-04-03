
            <h1>Mis transacciones</h1>
            <hr>
            {{if mostrar}}

            <table>
                <thead>
                    <tr>
                    <th>Codigo</th>
                    <th>Fecha</th>
                    <th>Observación</th>
                    <th>Forma de pago</th>
                    <th>Total</th>
                    <th>Detalle</th>
                    </tr>
            </thead>

            <tbody>
                {{foreach misTransacciones}}
                <tr>
                <td>{{doccod}}</td>
                <td>{{docfch}}</td>
                <td>{{docobs}}</td>
                <td>{{docFrmPgo}}</td>
                <td>{{Total}}</td>
                <td><a href="index.php?page=mnt.miDetalle.miDetalle&doccod={{doccod}}">Ver</a></td>
                </tr>
                {{endfor misTransacciones}}
            </tbody>
            
        </table>
        {{endif mostrar}}
         {{ifnot mostrar}}
        <h2>No ha realizado ninguna transacción</h2>
       
        {{endifnot mostrar}}
      