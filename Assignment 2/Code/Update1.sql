update person as p
set address_city = 'Coimbra', 
address_street = 'Avenida das Flores' 
where exists(
	select p.vat 
	from client as c
	where p.name = 'John Smith'
	and c.vat = p.vat);
