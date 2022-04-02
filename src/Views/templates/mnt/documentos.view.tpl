
            <h1>Lista de documentos</h1>
            <hr>

            <table>
                <thead>
                    <tr>
<th>doccod</th>
<th>docfch</th>
<th>usercod</th>
<th>docobs</th>
<th>docshipping</th>
<th>docest</th>
<th>docmeta</th>
<th>docfchdlv</th>
<th>docestdlv</th>
<th>docFrmPgo</th>
<th><a href="index.php?page=mnt.documentos.documento&mode=INS&doccod=0">+</a></th>

                    </tr>
            </thead>

            <tbody>
                {{foreach documento_fiscal}}
                <tr>
<td>{{doccod}}</td>
<td><a href="index.php?page=mnt.documentos.documento&mode=DSP&doccod={{doccod}}">{{docfch}}</a></td>
<td>{{usercod}}</td>
<td>{{docobs}}</td>
<td>{{docshipping}}</td>
<td>{{docest}}</td>
<td>{{docmeta}}</td>
<td>{{docfchdlv}}</td>
<td>{{docestdlv}}</td>
<td>{{docFrmPgo}}</td>
<td><a href="index.php?page=mnt.documentos.documento&mode=UPD&doccod={{doccod}}"/a>Editar</td>
&nbsp;<td><a href="index.php?page=mnt.documentos.documento&mode=DEL&doccod={{doccod}}"/a>Eliminar</td>

                    </tr>
                {{endfor documento_fiscal}}
            </tbody>
            
        </table>