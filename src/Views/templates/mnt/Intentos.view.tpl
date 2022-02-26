<h1>Intentos de pago</h1>
<hr>
<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Monto</th>
            <th>Fecha vencimiento</th>
            <th>Estado</th>
             <th><a href="index.php?page=mnt.intentospagos.intento&mode=INS&id=0">+</a></th>
        </tr>
    </thead>

    <tbody>
        {{foreach intentospagos}}
        <tr>
            <td>{{id}}</td>
            <td>{{fecha}}</td>           
            <td><a href="index.php?page=mnt.intentospagos.intento&mode=DSP&id={{id}}">{{cliente}}</a></td>
            <td>{{monto}}</td>
            <td>{{fechaVencimiento}}</td>
            <td>{{estado}}</td>
            <td><a href="index.php?page=mnt.intentospagos.intento&mode=UPD&id={{id}}">Editar</a>
            &nbsp;<a href="index.php?page=mnt.intentospagos.intento&mode=DEL&id={{id}}">Eliminar</a>
            </td>
        </tr>
        {{endfor intentospagos}}
    </tbody>
    
</table>