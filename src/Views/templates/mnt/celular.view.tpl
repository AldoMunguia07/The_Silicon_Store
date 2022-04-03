
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-celulars-celular&mode={{mode}}&invPrdId={{invPrdId}}" method="post">

            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="invPrdId" class="col-5">Codigo</label>
                        <input class="col-7"  id="invPrdId" name="invPrdId" type="text" value="{{invPrdId}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="nombre">Celular</label>
                        <input class="col-7" id="nombre" name="nombre"   type="text" value="{{nombre}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="descripcion">Descripción</label>
                        <input class="col-7" id="descripcion" name="descripcion"   type="text" value="{{descripcion}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="precio">Precio</label>
                        <input class="col-7" id="precio" name="precio"   type="text" value="{{precio}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                <label class="col-5" for="option">Estado</label>
                <select class="col-7"  name="estado" id="estado">
                    {{foreach cmbEstado}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                    {{endfor cmbEstado}}
                </select>
            </fieldset>



            <fieldset class="row flex-center align-center">
                <label class="col-5" for="option">Marca</label>
                <select class="col-7"  name="idMarca" id="idMarca">
                    {{foreach cmbMarca}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                    {{endfor cmbMarca}}
                </select>
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
                    location.assign("index.php?page=mnt.celulars.celulars")
                })
                });
            </script>