create view dim_date as 
select date_timestamp as ConsultDate, 
	extract(day from date_timestamp) as Day, 
	extract(month from date_timestamp) as Month, 
	extract(year from date_timestamp) as Year 
from consult;
