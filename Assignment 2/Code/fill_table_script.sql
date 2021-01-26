/* Person tables */

INSERT INTO person(VAT, name, address_street, address_city, address_zip) 
VALUES 
	(123456780, 'John Smith', 'Avenida da Liberdade', 'Lisbon', 13824),
	(123456781, 'John Smith', 'Avenida de Berlim', 'Lisbon', 13927),	
	(123456782, 'Thomas Edison', 'Avenida das Forças Armadas', 'Lisbon', 13525),
	(123456783, 'Erwin Schrodinger', 'Avenida de Roma', 'Lisbon', 13734),		
	(123456784, 'Sir Isaac Newton', 'Avenida do Brasil', 'Lisbon', 13626),	
	(123456785, 'Albert Einstein', 'Rua Garret', 'Lisbon', 13439), 		
	(123456786, 'Marie Curie', 'Avenida dos Aliados', 'Porto', 43201),		
	(123456787, 'Charles Darwin', 'Avenida da Boavista', 'Porto', 43224),	
	(123456788, 'James Maxwell', 'Rua das Flores', 'Porto', 42985),	
	(123456789, 'Archimedes', 'Rua Santa Catarina', 'Porto', 43253),
	(123456790, 'John Smith', 'Avenida Luis silva', 'Porto', 42155);




/* Client table */

INSERT INTO client(VAT)
VALUES 
	(123456780),
	(123456782),
	(123456783), 
	(123456784), 
	(123456785),
	(123456788),
	(123456789),
	(123456790);



/* Veterinary table */

INSERT INTO veterinary(VAT, specialization, bio)
VALUES 
	(123456780, 'Ophthalmology','Someone that enjoys their personal freedom'),
	(123456781, 'Nutrition', 'Occasionally visits Germany'),
	(123456786, 'Radiology', 'Always supportive towards my allies'),
	(123456790, 'Orthopedy', 'Taught by the great Luis Silva');



/* Veterinary assistant */

INSERT INTO assistant(VAT)
VALUES 
	(123456782), 
	(123456787);

/* Phone number table

foreign key(VAT) references person(VAT));

*/

INSERT INTO phone_number(VAT, phone)
VALUES 
	(123456780, 908765432), 
	(123456781, 918765432),
	(123456782, 928765432), 
	(123456783, 938765432),
	(123456784, 948765432),
	(123456785, 958765432), 
	(123456786, 968765432), 
	(123456787, 978765432), 
	(123456788, 988765432),
	(123456789, 998765432);



/* Species table */

INSERT INTO species(name, description)
VALUES 
	('Mammal', 'Hot blood animals with fur'),
	('Canis Lupus', 'Includes all sub-species of wolf'),
	('Canis lupus arctos','The greatest wolf of them all'),
	('Dog', 'Canis Lupus Familiaris - Mans best friend'),
	('Chihuahua', 'Very small dog. Shakes, trembles and barks with every inch of its body. Basically a demon trapped into a ladys dog body'),
	('Boxer','Very good boy. Leaves saliva everywhere'),
	('Husky', 'The fluffiest. Very good boy'),	
	('Golden Retriever','The best boy of them all'),
	('Fish', 'Swims very good'),
	('Carassius auratus','The classic golden fish'),
	('Felis', 'Small felines'),
	('Felis Bieti','Chinese wild cat'),
	('Felis Catus', 'Doesnt care about anything'),
	('Bird', 'Likes to fly'),
	('Cacatuidae','Very intelligent bird. Likes to party'),
	('Melopsittacus Undulatus', 'Small bird. Can be very mean'),
	('Agapornis Roseicollis', 'Very beautiful bird, sings very nice'),
	('Reptile', 'Cold blood animals - do not confuse with fish'),
	('Testudinidae', 'Very very slow'),
	('Crocodylidae','Very very big reptile. He doesnt bite, he just wants to play'),
	('Cheloniidae', 'Turtle that is still slow in land but swims very good');




/* Generalization species table 

foreign key(name1) references species(name),
foreign key(name2) references species(name));

*/

INSERT INTO generalization_species(name1, name2)
VALUES 
	('Canis Lupus', 'Mammal'),
	('Canis lupus arctos', 'Canis Lupus'),
	('Dog', 'Canis Lupus'),
	('Chihuahua', 'Dog'),
	('Boxer', 'Dog'),
	('Husky', 'Dog'),
	('Golden Retriever', 'Dog'),
	('Felis', 'Mammal'),
	('Felis Catus','Felis'),
	('Felis Bieti', 'Felis'),
	('Carassius auratus','Fish'),
	('Cacatuidae', 'Bird'),
	('Melopsittacus Undulatus', 'Bird'),
	('Agapornis Roseicollis', 'Bird'),
	('Testudinidae','Reptile'),
	('Crocodylidae','Reptile'),
	('Cheloniidae','Reptile');




/* Animal table 

foreign key(VAT) references person(VAT),
foreign key(species_name) references species(name));

*/

INSERT INTO animal(name, VAT, species_name, colour, gender, birth_year, age)
VALUES 
	('Paradox', 123456783, 'Felis Catus', 'black', 'male', 2013, year(current_timestamp) - birth_year),
	('Galileo', 123456784, 'Golden Retriever', 'golden', 'male', 2011, year(current_timestamp) - birth_year),
	('Galileia', 123456784, 'Golden Retriever', 'golden', 'female', 2011, year(current_timestamp) - birth_year),
	('Jacinto', 123456785, 'Bird', 'green', 'male', 2015, year(current_timestamp) - birth_year),
	('Descartes', 123456789, 'Bird', 'white', 'male', 2017, year(current_timestamp) - birth_year),
	('Atila', 123456784, 'Boxer', 'brown', 'male', 2014, year(current_timestamp) - birth_year),
	('Faraday', 123456789, 'Cheloniidae', 'green', 'female', 2006, year(current_timestamp) - birth_year),
	('Gragas', 123456780, 'Crocodylidae', 'green', 'male', 1970, year(current_timestamp) - birth_year),
	('Alex', 123456780, 'Boxer', 'brown', 'male', 2012, year(current_timestamp) - birth_year),
	('Jacinta', 123456785, 'Bird', 'red', 'female', 2015, year(current_timestamp) - birth_year);




/* consult table 

foreign key(name, VAT_owner) references animal(name, VAT),
foreign key(VAT_client) references person(VAT),
foreign key(VAT_vet) references person(VAT));

*/

INSERT INTO consult(name, VAT_owner, date_timestamp, s, o, a, p, VAT_client, VAT_vet, weight)
VALUES 
	('Gragas', 123456780, '2017-05-30', 'had teeth pain', 'found fish stuck between teeth', 'clean teeth', 'but dental floss', 123456780, 123456790, 1135.40),
	('Alex', 123456780, '2016-12-11', 'had teeth pain', 'found cavity', 'remove tooth', 'but dental floss', 123456780, 123456790, 35.25),
	('Paradox', 123456783, '2017-01-04', 'complained alot', 'swelled belly', 'kidney malfunction', 'get some meds', 123456783, 123456780, 3.89),
	('Galileo', 123456784, '2017-09-17', 'spots on the skin', 'fungal infection on the skin', 'ringworm', 'get some meds', 123456784, 123456780, 40.10),
	('Galileia', 123456784, '2017-09-17', 'complained alot', 'swelled belly', 'stomach failure', 'get some rest', 123456785, 123456781, 35.90),
	('Gragas', 123456780, '2016-05-30', 'routine check-up', 'found nothing noticeable', 'make blood analysis', 'rest', 123456780, 123456790, 1122.30),
	('Galileo', 123456784, '2017-09-18', 'more spots on the skin', 'fungal infection on the skin', 'ringworm', 'get ultra meds', 123456784, 123456780, 39.90),
	('Jacinto', 123456785, '2017-05-30', 'has beak pain', 'beak was normal but bird is a bit obese', 'stop being a crybird', 'go home', 123456782, 123456781, 0.38),
	('Descartes', 123456789, '2017-04-17', 'didnt dance to music', 'had obstructed ears', 'use cotton swab', 'buy cotton swab', 123456788, 123456786, 0.41),
	('Faraday', 123456789, '2018-01-22', 'didnt move', 'shows signs of obesity', 'ate a lot of junk food', 'Moderate and balanced food', 123456789, 123456786, 160.23),
	('Faraday', 123456789, '2018-02-22', 'still didnt move', 'still looks obese and stomach ache', 'still ate a lot of junk food', 'Moderate and balanced food and meds', 123456789, 123456786, 180.23),
    	('Atila', 123456784, '2017-02-15', 'checkup consult', 'healthy but a little obese', 'obese', 'go run', 123456784, 123456780, 31.23),
	('Atila', 123456784, '2017-03-15', '2nd checkup consult', 'lost signs of obesity', 'healthy', 'keep diet', 123456784, 123456780, 29.23);



/* participation table 

foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner, date_timestamp),
foreign key(VAT_assistant) references person(VAT));

*/

INSERT INTO participation(name, VAT_owner, date_timestamp, VAT_assistant)
VALUES 
	('Galileo', 123456784, '2017-09-17', 123456782),
	('Descartes', 123456789, '2017-04-17', 123456787),
	('Faraday', 123456789, '2018-01-22', 123456787),
	('Gragas', 123456780, '2016-05-30', 123456787),
	('Gragas', 123456780, '2016-05-30', 123456782),
	('Gragas', 123456780, '2017-05-30', 123456787),
	('Gragas', 123456780, '2017-05-30', 123456782),
	('Atila', 123456784, '2017-02-15', 123456782);




/* Diagnosis code table */

INSERT INTO diagnosis_code(code, name)
VALUES 
	(6281, 'Kidney Failure'),
	(5683, 'Stomach Failure'),
	(0076, 'Cancer'),
	(4409, 'Ear Infection'),
	(8320, 'Ringworm'),
	(1542, 'Inflamed Gum'),
	(1532, 'Teeth Pain');



 
/* consult diagnosis table 

foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner, date_timestamp),
foreign key(code) references diagnosis_code(code));

*/

INSERT INTO consult_diagnosis(code, name, VAT_owner, date_timestamp)
VALUES 
	(6281, 'Paradox', 123456783, '2017-01-04'),
	(6281, 'Faraday', 123456789, '2018-02-22'),
	(4409, 'Atila', 123456784, '2017-03-15'),
	(8320, 'Galileo', 123456784, '2017-09-17'),
	(5683, 'Galileia', 123456784, '2017-09-17'),
	(8320, 'Galileo', 123456784, '2017-09-18'),
	(1542, 'Gragas', 123456780, '2017-05-30'),
	(1532, 'Gragas', 123456780, '2017-05-30'),
	(6281, 'Gragas', 123456780, '2016-05-30'),
	(1532, 'Alex', 123456780, '2016-12-11');




/* medication table */

INSERT INTO medication(name, lab, dosage)
VALUES 
	('Amoxicillin', 'AMOCLAVAM', '80 to 90 mg per kg'),
	('Imodium A-D', 'IMODIUM', '0.3 to 0.6 mL per pound'),
	('Ultra Imodium A-D', 'IMODIUM', '1.3 to 1.6 mL per pound'),
	('No Teeth Pain', 'TEETH LAB', '90 mg per kg'),
	('Get Good Gum', 'BIG GREEN BOYS', '0.6 g per kg'),
	('Gum Supplement', 'BIG GREEN BOYS', '0.3 g per kg');




/* prescription table 

foreign key(code, name, VAT_owner, date_timestamp) references consult_diagnosis(code, name, VAT_owner, date_timestamp),
foreign key(name_med, lab, dosage) references medication(name, lab, dosage));

*/

INSERT INTO prescription(code, name, VAT_owner, date_timestamp, name_med, lab, dosage, regime)
VALUES 
	(6281, 'Paradox', 123456783, '2017-01-04', 'Amoxicillin', 'AMOCLAVAM', '80 to 90 mg per kg', 'every day'),
	(6281, 'Faraday', 123456789, '2018-02-22', 'Amoxicillin', 'AMOCLAVAM', '80 to 90 mg per kg', 'every day'),
	(8320, 'Galileo', 123456784, '2017-09-17', 'Imodium A-D', 'IMODIUM', '0.3 to 0.6 mL per pound', 'two to three times a day'),
	(8320, 'Galileo', 123456784, '2017-09-18', 'Ultra Imodium A-D', 'IMODIUM', '1.3 to 1.6 mL per pound', 'two times a day'),
	(1532, 'Gragas', 123456780, '2017-05-30', 'No Teeth Pain', 'TEETH LAB', '90 mg per kg', 'fit the pills box into his favourite food'),
	(1542, 'Gragas', 123456780, '2017-05-30', 'Get Good Gum', 'BIG GREEN BOYS', '0.6 g per kg', 'fit the pills box into his favourite food'),
	(1542, 'Gragas', 123456780, '2017-05-30', 'Gum Supplement', 'BIG GREEN BOYS', '0.3 g per kg', 'spray on mouth after brushing teeth'),
	(1532, 'Alex', 123456780, '2016-12-11', 'No Teeth Pain', 'TEETH LAB', '90 mg per kg', 'three times per day');




/* medical indicator table */

INSERT INTO indicator(name, reference_value, units, description)
VALUES 
	('Microalbumin', 310.00, 'milligrams' , 'urine protein'),
	('Glucose level', 110.00, 'milligrams', 'blood sugar'),
	('Cholesterol level', 1.20, 'grams', 'blood fat level'),
	('Acidosis', 150.00, 'milliliters', 'Blood acid level'),
	('Creatinine level', 1.00, 'milligrams', 'proportional to muscle');




/* medical procedure table 

foreign key(name, VAT_owner, date_timestamp) references consult(name, VAT_owner,date_timestamp));

*/

INSERT INTO medical_procedure(name, VAT_owner, date_timestamp, num, description)
VALUES 
	('Paradox', 123456783, '2017-01-04', 0, 'radiography exam'),
	('Paradox', 123456783, '2017-01-04', 1, 'blood test procedure'),
	('Paradox', 123456783, '2017-01-04', 2, 'urine test procedure'),
	('Gragas', 123456780, '2017-05-30', 0, 'radiography exam'),
	('Gragas', 123456780, '2016-05-30', 0, 'blood test procedure');




/* performed table 

foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num),
foreign key(VAT_assistant) references person(VAT));

*/

INSERT INTO performed(name, VAT_owner, date_timestamp, num, VAT_assistant)
VALUES 
	('Paradox', 123456783, '2017-01-04', 0, 123456782),
	('Paradox', 123456783, '2017-01-04', 1, 123456787),
	('Paradox', 123456783, '2017-01-04', 2, 123456787),
	('Gragas', 123456780, '2017-05-30', 0, 123456787),
	('Gragas', 123456780, '2016-05-30', 0, 123456782);




/* radiography table 

foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num));

*/

INSERT INTO radiography(name, VAT_owner, date_timestamp, num, rad_file)
VALUES 
	('Paradox', 123456783, '2017-01-04', 0, '/Documents/Radiography_Exams/Paradox123456783'),
	('Gragas', 123456780, '2017-05-30', 0, '/Documents/Radiography_Exams/Gragas123456780');




/* test_procedure  

foreign key(name, VAT_owner, date_timestamp, num) references medical_procedure(name, VAT_owner, date_timestamp, num));

*/

INSERT INTO test_procedure(name, VAT_owner, date_timestamp, num, test_type)
VALUES 
	('Paradox', 123456783, '2017-01-04', 1, 'blood'),
	('Paradox', 123456783, '2017-01-04', 2, 'urine'),
	('Gragas', 123456780, '2016-05-30', 0, 'blood');




/* Produced indicator table 

foreign key(name, VAT_owner, date_timestamp, num) references test_procedure(name, VAT_owner, date_timestamp, num),
foreign key(indicator_name) references indicator(name));

*/

INSERT INTO produced_indicator(name, VAT_owner, date_timestamp, num, indicator_name, indicator_value)
VALUES 
	('Paradox', 123456783, '2017-01-04', 1, 'Creatinine level', 2.3),
	('Paradox', 123456783, '2017-01-04', 2, 'Microalbumin',  300.00),
	('Gragas', 123456780, '2016-05-30', 0, 'Creatinine level', 0.9);




