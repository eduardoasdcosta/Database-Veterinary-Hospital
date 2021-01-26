select p.name as Name, p.address_city as City, p.address_street as Street, p.address_zip as ZIP
from animal as a1, person as p 
where not exists(
	select a2.vat 
	from animal as a2 
	where a2.vat = a1.vat and a2.species_name <> 'Bird'
	) 
and p.vat = a1.vat
group by p.vat;
