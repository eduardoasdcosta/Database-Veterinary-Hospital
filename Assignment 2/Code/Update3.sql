delete from client 
where exists(
	select p.name 
	from person as p 
	where p.name = 'John Smith' 	
	and client.vat = p.vat);
