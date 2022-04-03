
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-marcas-marca&mode={{mode}}&idMarca={{idMarca}}" method="post">

            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="idMarca" class="col-5">Codigo</label>
                        <input class="col-7"  id="idMarca" name="idMarca" type="text" value="{{idMarca}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="marca">Marca</label>
                        <input class="col-7" id="marca" name="marca"   type="text" value="{{marca}}" {{readonly}} placeholder="">
                    </fieldset>

                   

            <fieldset class="row flex-center align-center">
                <label class="col-5" for="option">Estado</label>
                <select class="col-7"  name="estado" id="estado">
                    {{foreach cmbEstado}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                    {{endfor cmbEstado}}
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
                    location.assign("index.php?page=mnt.marcas.marcas")
                })
                });
            </script>