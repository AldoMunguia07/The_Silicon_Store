
            <h1>Lista de inventarios</h1>
            <hr>

            <table>
                <thead>
                    <tr>
                        <th>Celular</th>
                        <th>Marca</th>
                        <th>Cantidad</th>
                        <th><a href="index.php?page=mnt.inventarios.inventario&mode=INS&idInventario=0&invPrdId=0">+</a></th>
                    </tr>
            </thead>

            <tbody>
                {{foreach inventario}}
                <tr>
                    
                    <td><a href="index.php?page=mnt.inventarios.inventario&mode=DSP&idInventario={{idInventario}}&invPrdId={{invPrdId}}">{{nombre}}</a></td>
                    <td>{{marca}}</td>
                    <td>{{cantidad}}</td>
                    <td><a href="index.php?page=mnt.inventarios.inventario&mode=UPD&idInventario={{idInventario}}&invPrdId={{invPrdId}}&nombre={{nombre}}"/a>Editar</td>
                    &nbsp;<td><a href="index.php?page=mnt.inventarios.inventario&mode=DEL&idInventario={{idInventario}}&invPrdId={{invPrdId}}&nombre={{nombre}}"/a>Eliminar</td>


                    </tr>
                {{endfor inventario}}
            </tbody>
            
        </table>