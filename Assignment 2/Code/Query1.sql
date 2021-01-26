select distinct a.name as Animal_Name, p2.name as Owner_Name, species_name as Species_Name, age as Animal_Age  
from consult as c, animal as a, veterinary as v, client as owner, person as p1, person as p2 
where v.VAT = c.VAT_vet 
and v.VAT = p1.VAT 
and p1.name = 'John Smith' 
and c.name = a.name 
and c.VAT_owner = a.VAT 
and owner.VAT = a.VAT 
and owner.VAT = p2.VAT;
