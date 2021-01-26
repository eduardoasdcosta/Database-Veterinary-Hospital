select distinct a.name as Animal_Name, p.name as Owner_Name, a.species_name as Species_Name, a.age as Animal_Age  
from animal as a, person as p, consult as c 
where c.date_timestamp = (
	select max(date_timestamp) 
	from consult as c2 
	where c2.name = c.name 
	and c.weight > 30) 
and (LOCATE('obese', c.o) or LOCATE('obesity', c.o)) 
and a.name = c.name 
and a.VAT = c.VAT_owner 
and p.VAT = a.VAT;
