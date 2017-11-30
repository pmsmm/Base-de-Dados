a)
select nome
from fornecedor f, fornece_sec natural join produto
where( f.nif = fornece_sec.nif or f.nif = produto.forn_primario)
group by f.nif
having count(distinct categoria) >= all
	(select count(distinct categoria)
	from fornecedor f, fornece_sec natural join produto
	where( f.nif = fornece_sec.nif or f.nif = produto.forn_primario)
	group by f.nif)



b) 
select nome, nif
from fornecedor f
where not exists(
(select nome
from categoria_simples)
except
(select p.categoria
from produto p, fornecedor s
where p.forn_primario=s.nif and s.nif=f.nif));


c)
(select ean from produto)
except
(select ean from reposicao);


d)
select ean
from fornece_sec
group by ean
having count(nif) > 10;


e)
select ean
from reposicao
group by ean
having count(distinct operador)=1;


