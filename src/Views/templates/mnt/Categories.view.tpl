<h1>Categorias</h1>
<hr>
<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Categoria</th>
            <th>Estado</th>
            <th><a href="index.php?page=mnt.categorias.categoria&mode=INS&catid=0">+</a></th>
        </tr>
    </thead>

    <tbody>
        {{foreach categorias}}
        <tr>
            <td>{{catid}}</td>
            <td><a href="index.php?page=mnt.categorias.categoria&mode=DSP&catid={{catid}}">{{catnom}}</a></td>
            <td>{{catest}}</td>
            <td><a href="index.php?page=mnt.categorias.categoria&mode=UPD&catid={{catid}}">Editar</a>
            &nbsp;<a href="index.php?page=mnt.categorias.categoria&mode=DEL&catid={{catid}}">Eliminar</a>
            </td>
        </tr>
        {{endfor categorias}}
    </tbody>
    
</table>