
            <h1>Lista de marcas</h1>
            <hr>

            <table>
                <thead>
                    <tr>
<th>Codigo</th>
<th>Marca</th>
<th>Estado</th>
<th><a href="index.php?page=mnt.marcas.marca&mode=INS&idMarca=0">+</a></th>

                    </tr>
            </thead>

            <tbody>
                {{foreach marca}}
                <tr>
<td>{{idMarca}}</td>
<td><a href="index.php?page=mnt.marcas.marca&mode=DSP&idMarca={{idMarca}}">{{marca}}</a></td>
<td>{{estado}}</td>
<td><a href="index.php?page=mnt.marcas.marca&mode=UPD&idMarca={{idMarca}}"/a>Editar</td>
&nbsp;<td><a href="index.php?page=mnt.marcas.marca&mode=DEL&idMarca={{idMarca}}"/a>Eliminar</td>

                    </tr>
                {{endfor marca}}
            </tbody>
            
        </table>