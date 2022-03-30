<h1>{{SITE_TITLE}}</h1>
<h1><a href="#">Ver mi carrito</a></h1>
{{foreach celular}}
  <section>
    <h2>{{nombre}}</h2>
    <h3>{{descripcion}}</h3>
    <span>{{precio}}</span>
    <br>
    <span>{{StockDisp}}</span>
  </section>
{{endfor celular}}
