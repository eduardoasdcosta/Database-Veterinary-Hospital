create view facts_consults as 
select distinct 
	animal_name as Name, 
	animal_vat as Vat, 
	ConsultDate as Timestamp, 
	(select count(*) from medical_procedure as p where p.name = animal_name and p.vat_owner = animal_vat and p.date_timestamp = ConsultDate) as Num_Procedures, 
	(select count(*) from prescription as pre where pre.name = animal_name and pre.vat_owner = animal_vat and pre.date_timestamp = ConsultDate) as Num_Medications 
from dim_animal, dim_date, consult as c 
where c.name = animal_name 
and c.vat_owner = animal_vat 
and c.date_timestamp = ConsultDate;

