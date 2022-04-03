
            <h1>Celulares</h1>
            <hr>

            <table>
                <thead>
                    <tr>
                    <th>Codigo</th>
                    <th>Celular</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Estado</th>
                    
                    <th><a href="index.php?page=mnt.celulars.celular&mode=INS&invPrdId=0">+</a></th>

                    </tr>
            </thead>

            <tbody>
                {{foreach celular}}
                <tr>
                    <td>{{invPrdId}}</td>
                    <td><a href="index.php?page=mnt.celulars.celular&mode=DSP&invPrdId={{invPrdId}}">{{nombre}}</a></td>
                    <td>{{descripcion}}</td>
                    <td>{{precio}}</td>
                    <td>{{marca}}</td>
                    <td>{{estado}}</td>                    
                    <td><a href="index.php?page=mnt.celulars.celular&mode=UPD&invPrdId={{invPrdId}}"/a>Editar</td>
                    &nbsp;<td><a href="index.php?page=mnt.celulars.celular&mode=DEL&invPrdId={{invPrdId}}"/a>Eliminar</td>

                    </tr>
                {{endfor celular}}
            </tbody>
            
        </table>