-- запрос 1
select 
t1.brand,
t.model, t.production_end
from AUTO_MODEL t
left join AUTO_BRAND t1 on (t1.id = t.brand_id)
where t.production_end < '01.10.2018'
group by t1.brand, t.model, t.production_end


-- запрос 2
select 
t1.brand, t.model, t2.service_name, t2.price
from AUTO_MODEL t
left join AUTO_BRAND t1 on (t1.id = t.brand_id)
cross join AUTO_SERVICE t2
where t.production_end is null
and price > 1000
group by t1.brand, t.model, t2.service_name, t2.price

