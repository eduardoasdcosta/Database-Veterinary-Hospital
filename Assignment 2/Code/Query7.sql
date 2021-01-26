select SpeciesName, dc.name as ConditionName
from(
	select species_name as SpeciesName, code 
	from consult_diagnosis natural join animal, generalization_species 
	where name2 = 'Dog' 
	and species_name = name1 
	group by species_name, code 
	having count(*) = (
		select max(c.num) 
		from (
			select species_name as sn, count(*) as num 
			from consult_diagnosis natural join animal, generalization_species 
			where name2 = 'Dog' 
			and species_name = name1 
			group by species_name, code
			) as c 
		where sn = SpeciesName)
	) as SpeciesNameCount, diagnosis_code as dc 
where dc.code = SpeciesNameCount.code
group by SpeciesName;
