select z.invPrdId, z.nombre, z.descripcion, z.precio, z.cantidad, sum(z.cartCtd) as cartCtd , z.cantidad - sum(z.cartCtd) as StockDisp
from (
select a.invPrdId, a.nombre, a.descripcion, a.precio, b.cantidad,  ifnull(d.cartCtd, 0) as cartCtd from
	celular a
    left join inventario b on a.invPrdId = b.invPrdId
    left join carretilla_anon d on a.invPrdId = d.invPrdId and d.cartIat >= now()
where a.estado='ACT'
union all
select a.invPrdId, a.nombre, a.descripcion, a.precio, b.cantidad,  ifnull(e.cartCtd, 0) as cartCtd from
	celular a
    left join inventario b on a.invPrdId = b.invPrdId
    left join carretilla_auth e on a.invPrdId = e.invPrdId and e.cartIat >= now()
where a.estado='ACT' ) as z
group by  z.invPrdId, z.nombre, z.descripcion, z.precio, z.cantidad
;

select * from celular a inner join carretilla_anon b on a.invPrdId = b.invPrdId where b.anoncartid = ?;
select * from celular a inner join carretilla_auth b on a.invPrdId = b.invPrdId where b.usercod = ?;

