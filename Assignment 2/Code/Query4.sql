select distinct p.name as Name, p.VAT as VAT, address_street as Street, address_city as City, address_zip as ZIP
from animal as a, person as p, client as c 
where c.VAT = p.VAT 
and p.VAT not in(select VAT from animal);
