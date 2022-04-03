
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-inventarios-inventario&mode={{mode}}&idInventario={{idInventario}}&invPrdId={{invPrdId}}" method="post">


            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="idInventario" class="col-5">Codigo inventario</label>
                        <input class="col-7"  id="idInventario" name="idInventario" type="text" value="{{idInventario}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    {{if isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="option">Celular</label>
                        <select class="col-7"  name="invPrdId" id="invPrdId">
                            {{foreach cmbCelulares}}
                            <option value="{{value}}" {{selected}}>{{text}}</option>
                            {{endfor cmbCelulares}}
                        </select>
                    </fieldset>
                    {{endif isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="cantidad">Cantidad</label>
                        <input class="col-7" id="cantidad" name="cantidad"   type="text" value="{{cantidad}}" {{readonly}} placeholder="">
                    </fieldset>

            
            

            <fieldset class="row flex-end align-center">
                <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
                &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
                &nbsp;
            </fieldset>
            </form>
        </section>
            

            <script>
                document.addEventListener("DOMContentLoaded", (e)=>{
                document.getElementById("btnCancelar").addEventListener("click", (e)=>{
                    e.preventDefault();
                    e.stopPropagation();
                    location.assign("index.php?page=mnt.inventarios.inventarios")
                })
                });
            </script>