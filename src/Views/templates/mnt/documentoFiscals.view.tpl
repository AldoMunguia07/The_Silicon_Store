
            <h1>Lista de documentoFiscals</h1>
            <hr>

            <table>
                <thead>
                    <tr>
<th>doccod</th>
<th>invPrdId</th>
<th>docCtd</th>
<th>docPrc</th>
<th>docIva</th>
<th>docLObs</th>
<th>docDsc</th>
<th><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=INS&doccod=0">+</a></th>
<th><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=INS&invPrdId=0">+</a></th>

                    </tr>
            </thead>

            <tbody>
                {{foreach documento_fiscal_lineas}}
                <tr>
<td>{{doccod}}</td>
<td><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=DSP&invPrdId={{invPrdId}}">{{invPrdId}}</a></td>
<td>{{docCtd}}</td>
<td>{{docPrc}}</td>
<td>{{docIva}}</td>
<td>{{docLObs}}</td>
<td>{{docDsc}}</td>
<td><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=UPD&doccod={{doccod}}"/a>Editar</td>
&nbsp;<td><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=DEL&doccod={{doccod}}"/a>Eliminar</td>
<td><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=UPD&invPrdId={{invPrdId}}"/a>Editar</td>
&nbsp;<td><a href="index.php?page=mnt.documentoFiscals.documentoFiscal&mode=DEL&invPrdId={{invPrdId}}"/a>Eliminar</td>

                    </tr>
                {{endfor documento_fiscal_lineas}}
            </tbody>
            
        </table>